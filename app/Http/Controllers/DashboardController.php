<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShiftMaster;
use App\Models\RmPmMaster;
use App\Models\RmPmCatMaster;
use App\Models\RmPmStockMaster;
use App\Models\RmPmStockWarehouseMaster;
use App\Models\FgMaster;
use App\Models\FgCatMaster;
use App\Models\FgStockMaster;
use App\Models\FgStockTransaction;
use App\Models\FgDispatchMaster;
use App\Models\ProductionLineMaster;
use App\Models\NotificationMaster;
use App\Models\FgCatBottleHtml;
use App\Models\SalesTargetMaster;
use App\Models\ProductionTimerMaster;
use App\Models\OrderDetails;
use App\Models\OrderMaster;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    public function notificationHandler(Request $request) {
        NotificationMaster::where("id", $request->id)
            ->update(["is_clicked" => 1]);

        $routeAddress = NotificationMaster::select("main_address")
            ->where("id", $request->id)
            ->first();

        if ($routeAddress) {
            return redirect()->route($routeAddress->main_address);
        } else {
            return redirect()->route("dashboard")->with("error", "No Route Found!!");
        }
    }

    public function getNotificationUpdates() {
        $notificationData = NotificationMaster::select("id", "route_address", "notification_title", "notification_msg", "created_at")
            ->where("is_clicked", 0)
            ->latest("created_at")
            ->get()->toArray();

        if ($notificationData) {
            $data = [
                "status" => "success",
                "notificationData" => $notificationData
            ];
        } else {
            $data = [
                "status" => "error"
            ];
        }

        return response()->json($data);
    }

    public function getUpdatesOfTheWarehouse() {

    }

    public function showDashboard(Request $request) {
        if ($request->session()->get("role_id") != 3 && $request->session()->get("role_id") != 4) {

            // ------ Bottle Data Starts
            $productionLineData = ProductionLineMaster::select("id", "line_name")
                ->where("is_active", 1)
                ->get()->toArray();
            
            $data["productionLineData"] = $productionLineData;

            if ($productionLineData) {
                $counter = 0;
                foreach ($productionLineData as $pLineData) {
                    $data["productionLineDataFG"][$counter]["productionLineDetails"] = $pLineData;
                    $data["productionLineDataFG"][$counter]["fgData"] = FgCatMaster::select(
                            "fg_cat_master.id",
                            "fg_cat_master.fg_cat_name",
                            "fg_master.fg_name",
                            "fg_cat_bottle_html.main_id",
                            "fg_cat_bottle_html.main_class",
                            "fg_cat_bottle_html.sub_class",
                            "fg_cat_bottle_html.inner_class",
                            "fg_cat_bottle_html.bottle_image",
                            "fg_cat_bottle_html.max_capacity"
                        )
                        ->leftJoin("fg_cat_bottle_html", "fg_cat_bottle_html.fg_cat_id", "=", "fg_cat_master.id")
                        ->leftJoin("fg_master", "fg_master.id", "=", "fg_cat_master.fg_id")
                        ->where("fg_cat_master.production_line_id", $pLineData["id"])
                        ->get()->toArray();
                    $counter++;
                }
            }

            // ------ Bottle Data Ends
            
            $data["fgData"] = FgStockMaster::select(
                    "fg_cat_master.fg_cat_name",
                    "fg_master.fg_name",
                    "fg_stock_master.stock_quantity"
                )
                ->leftjoin("fg_cat_master", "fg_cat_master.id", "=", "fg_stock_master.fg_cat_id")
                ->leftjoin("fg_master", "fg_master.id", "=", "fg_cat_master.fg_id")
                ->where("fg_stock_master.is_active", 1)
                ->get()->toArray();
            $data["fgTotalQuantity"] = FgStockMaster::sum('stock_quantity');
            
            // ---- Current Day stock
            $fgCatData = FgCatMaster::select(
                "fg_cat_master.id",
                "fg_cat_master.fg_cat_name",
                "fg_master.fg_name"
            )
            ->leftJoin(
                "fg_master",
                "fg_cat_master.fg_id",
                "=",
                "fg_master.id"
            )
            ->where("fg_cat_master.is_active", 1)
            ->get()
            ->toArray();

            // GET TODAY PRODUCTION TOTALS
            $todayProduction = FgStockTransaction::select(
                    "fg_cat_id",
                    DB::raw("SUM(stock_quantity) as total_production")
                )
                ->whereDate("created_at", Carbon::today())
                ->groupBy("fg_cat_id")
                ->pluck("total_production", "fg_cat_id");

            // FINAL ARRAY
            $data["currentdayProduction"] = [];
            $counter = 0;
            $data["currentDayTotalProduction"] = 0;
            foreach ($fgCatData as $fValues) {
                $data["currentdayProduction"][$counter]["fgData"] = $fValues;
                $data["currentdayProduction"][$counter]["production"] =
                    $todayProduction[$fValues["id"]] ?? 0;
                $data["currentDayTotalProduction"] = $data["currentDayTotalProduction"] + ($todayProduction[$fValues["id"]] ?? 0);
                $counter++;
            }

            $rmPmData = RmPmMaster::select("id", "rm_pm_name", "rm_pm_image")
                ->where("is_active", 1)
                ->get()->toArray();

            if ($rmPmData) {
                $rmPmStockWiseData = [];
                $counter = 0;
                foreach ($rmPmData as $rData) {
                    $rmPmStockWiseData[$counter] = $rData;
                    $rmPmStockWiseData[$counter]["rcData"] = RmPmCatMaster::select(
                        "rm_pm_cat_master.rm_pm_cat_name", 
                        "rm_pm_cat_master.cat_unit", 
                        "rm_pm_stock_warehouse_master.stock_quantity"
                        )
                        ->leftjoin("rm_pm_stock_warehouse_master", "rm_pm_cat_master.id", "=", "rm_pm_stock_warehouse_master.rm_pm_cat_id")
                        ->where("rm_pm_cat_master.rm_pm_id", $rData["id"])
                        ->get()->toArray();

                    $counter++;
                }
            }

            $data["rmPmStockWiseData"] = $rmPmStockWiseData;
            
            // ---------------- DISPATCH GRAPH DATA STARTS ----------------

            // FILTER TYPE
            $filter = $request->filter ?? "7days";
            
            // DATE RANGE
            if ($filter == "1day") {
                $startDate = Carbon::today();
                $endDate = Carbon::today();
                $groupFormat = "%H"; // Hour Wise
            } elseif ($filter == "1month") {
                $startDate = Carbon::now()->subDays(29);
                $endDate = Carbon::today();
                $groupFormat = "%d-%m"; // Date Wise
            } else {
                // DEFAULT 7 DAYS
                $startDate = Carbon::now()->subDays(6);
                $endDate = Carbon::today();
                $groupFormat = "%d-%m";
            }
            
            // GET ALL CATEGORY NAMES
            $fgCategories = FgCatMaster::select(
                    "id",
                    "fg_cat_name"
                )
                ->where("is_active", 1)
                ->get()
                ->toArray();
            
            // GET DISPATCH DATA
            $dispatchRawData = FgDispatchMaster::select(
                    DB::raw("DATE_FORMAT(bi_fg_dispatched_master.created_at, '$groupFormat') as dispatch_day"),
                    "fg_cat_master.fg_cat_name",
                    DB::raw("SUM(bi_fg_dispatched_master.fg_quantity) as total_qty")
                )
                ->leftJoin(
                    "fg_cat_master",
                    "fg_cat_master.id",
                    "=",
                    "fg_dispatched_master.fg_cat_id"
                )
                ->whereBetween(
                    DB::raw("DATE(bi_fg_dispatched_master.created_at)"),
                    [$startDate->toDateString(), $endDate->toDateString()]
                )
                ->groupBy(
                    "dispatch_day",
                    "fg_cat_master.fg_cat_name"
                )
                ->orderBy("dispatch_day")
                ->get()
                ->toArray();
            
            // FINAL FORMATTED ARRAY
            $finalDispatchData = [];
            foreach ($dispatchRawData as $row) {
                $day = $row["dispatch_day"];
                $category = $row["fg_cat_name"];
                $finalDispatchData[$day][$category] = $row["total_qty"];
            }

            // MAX VALUE FOR HEIGHT CALCULATION
            $maxDispatchQty = FgDispatchMaster::whereBetween(
                    DB::raw("DATE(created_at)"),
                    [$startDate->toDateString(), $endDate->toDateString()]
                )
                ->sum("fg_quantity");
            
            $data["dispatchGraphData"] = $finalDispatchData;
            $data["fgCategories"] = $fgCategories;
            $data["maxDispatchQty"] = $maxDispatchQty;
            $data["selectedFilter"] = $filter;
            
            // ---------------- DISPATCH GRAPH DATA ENDS ----------------
            
            // ---------------- PRODUCTION GRAPH DATA STARTS -------------

            // SEPARATE FILTER
            $productionFilter = $request->production_filter ?? "7days";
            
            
            // DATE RANGE
            if ($productionFilter == "1day") {
            
                $productionStartDate = Carbon::today();
                $productionEndDate = Carbon::today();
                $productionGroupFormat = "%H";
            
            } elseif ($productionFilter == "1month") {
            
                $productionStartDate = Carbon::now()->subDays(29);
                $productionEndDate = Carbon::today();
                $productionGroupFormat = "%d-%m";
            
            } else {
            
                // DEFAULT 7 DAYS
                $productionStartDate = Carbon::now()->subDays(6);
                $productionEndDate = Carbon::today();
                $productionGroupFormat = "%d-%m";
            }
            
            // GET PRODUCTION DATA
            $productionRawData = FgStockTransaction::select(
                    DB::raw("
                        DATE_FORMAT(
                            bi_fg_stock_transaction.created_at,
                            '$productionGroupFormat'
                        ) as production_day
                    "),
                    "fg_cat_master.fg_cat_name",
                    DB::raw("
                        SUM(
                            bi_fg_stock_transaction.stock_quantity
                        ) as total_qty
                    ")
                )
                ->leftJoin(
                    "fg_cat_master",
                    "fg_cat_master.id",
                    "=",
                    "fg_stock_transaction.fg_cat_id"
                )
                ->whereBetween(
                    DB::raw("DATE(bi_fg_stock_transaction.created_at)"),
                    [
                        $productionStartDate->toDateString(),
                        $productionEndDate->toDateString()
                    ]
                )
                ->groupBy(
                    "production_day",
                    "fg_cat_master.fg_cat_name"
                )
                ->orderBy("production_day")
                ->get()
                ->toArray();
            
            // FINAL ARRAY FORMAT
            $finalProductionData = [];
            foreach ($productionRawData as $row) {
                $day = $row["production_day"];
                $category = $row["fg_cat_name"];
                $finalProductionData[$day][$category] =
                    $row["total_qty"];
            }
            
            // MAX VALUE
            $maxProductionQty = FgStockTransaction::whereBetween(
                DB::raw("DATE(created_at)"),
                    [
                        $productionStartDate->toDateString(),
                        $productionEndDate->toDateString()
                    ]
                )
                ->sum("stock_quantity");
            
            $data["productionGraphData"] = $finalProductionData;
            $data["maxProductionQty"] = $maxProductionQty;
            $data["selectedProductionFilter"] = $productionFilter;
            
            // ---------------- PRODUCTION GRAPH DATA ENDS -------------

            // echo "<pre>";print_r($data);die();
            return view("dashboard.adminDash", $data);
        
        } else {

            if ($request->session()->get("role_id") == 3) {
                $data = [];

                /*
                |--------------------------------------------------------------------------
                | RM/PM DATA
                |--------------------------------------------------------------------------
                */

                // RM/PM Main
                $rmPmData = RmPmMaster::where("is_active", 1)
                    ->select("id", "rm_pm_name")
                    ->get();

                // Categories
                $rmPmCategories = RmPMCatMaster::select(
                        "id",
                        "rm_pm_id",
                        "rm_pm_cat_name",
                        "cat_unit"
                    )
                    ->get()
                    ->groupBy("rm_pm_id");

                // Warehouse Stock
                $warehouseStock = RmPmStockWarehouseMaster::pluck(
                    "stock_quantity",
                    "rm_pm_cat_id"
                );

                // Consumed Stock
                $consumedStock = RmPmStockMaster::pluck(
                    "stock_quantity",
                    "rm_pm_cat_id"
                );

                $data["rmpmData"] = [];
                $data["rmpmConsumedData"] = [];
                foreach ($rmPmData as $rmPm) {
                    $mainStock = [
                        "id" => $rmPm->id,
                        "rm_pm_name" => $rmPm->rm_pm_name,
                        "rcData" => []
                    ];

                    $consumed = [
                        "id" => $rmPm->id,
                        "rm_pm_name" => $rmPm->rm_pm_name,
                        "rcData" => []
                    ];

                    $categories = $rmPmCategories[$rmPm->id] ?? [];
                    foreach ($categories as $cat) {

                        // Main Warehouse Stock
                        $mainStock["rcData"][] = [
                            "rm_pm_cat_name" => $cat->rm_pm_cat_name,
                            "cat_unit"       => $cat->cat_unit,
                            "stock_quantity" => $warehouseStock[$cat->id] ?? 0
                        ];

                        // Consumed Remaining Stock
                        $consumed["rcData"][] = [
                            "rm_pm_cat_name" => $cat->rm_pm_cat_name,
                            "cat_unit"       => $cat->cat_unit,
                            "stock_quantity" => $consumedStock[$cat->id] ?? 0
                        ];
                    }

                    $data["rmpmData"][] = $mainStock;
                    $data["rmpmConsumedData"][] = $consumed;
                }

                /*
                |--------------------------------------------------------------------------
                | FG DATA
                |--------------------------------------------------------------------------
                */

                $fgData = FgMaster::where("is_active", 1)
                    ->select("id", "fg_name")
                    ->get();

                $fgCategories = FgCatMaster::select(
                        "id",
                        "fg_id",
                        "fg_cat_name"
                    )
                    ->get()
                    ->groupBy("fg_id");

                $fgStocks = FgStockMaster::pluck(
                    "stock_quantity",
                    "fg_cat_id"
                );

                $data["fgData"] = [];
                foreach ($fgData as $fg) {
                    $fgItem = [
                        "id" => $fg->id,
                        "fg_name" => $fg->fg_name,
                        "fgcData" => []
                    ];

                    $categories = $fgCategories[$fg->id] ?? [];
                    foreach ($categories as $cat) {
                        $fgItem["fgcData"][] = [
                            "fg_cat_name"   => $cat->fg_cat_name,
                            "stock_quantity" => $fgStocks[$cat->id] ?? 0
                        ];
                    }

                    $data["fgData"][] = $fgItem;
                }

                /*
                |--------------------------------------------------------------------------
                | SHIFT DATA
                |--------------------------------------------------------------------------
                */

                $shiftData = ShiftMaster::select(
                        "shift_from",
                        "shift_to",
                        "shift_over_status"
                    )
                    ->where("userID", $request->session()->get("userID"))
                    ->latest()
                    ->first();

                $data["shiftData"] = $shiftData;
                if ($shiftData) {
                    if ($shiftData->shift_over_status == 0) {
                        if (!$request->session()->has('shift_from')) {
                            $request->session()->put('shift_from', $shiftData->shift_from);
                            $request->session()->put('shift_to', $shiftData->shift_to);
                        }

                    } else {
                        $request->session()->forget(['shift_from', 'shift_to']);
                    }
                }

                return view("dashboard.warehouseDash", $data);

            } else {

                $data["orderData"] = OrderMaster::select(
                        "id",
                        "order_id",
                        "order_date",
                        "order_dispatch_date",
                        "order_dispatch_date_achieved",
                        "order_production_status",
                        "order_dispatch_status",
                        "payment_status",
                        "payment_approve_status"
                    )
                    ->where("is_active", 1)
                    ->where("order_by_id", $request->session()->get("userID"))
                    ->latest("created_at")
                    ->get()
                    ->toArray();

                $data["targetData"] = SalesTargetMaster::select("target_quantity", "achieved_target_quantity")
                    ->whereMonth("target_date", Carbon::now()->month)
                    ->whereYear("target_date", Carbon::now()->year)
                    ->where("user_id", $request->session()->get("userID"))
                    ->get()->toArray();

                $data["fgCatData"] = FgCatMaster::select("id", "fg_cat_name")
                    ->where("is_active", 1)
                    ->get()->toArray();

                if ($data["fgCatData"]) {
                    $counter = 0;
                    foreach ($data["fgCatData"] as $fgValues) {
                        $data["progressReport"][$counter]["fgData"] = $fgValues;
                        $data["progressReport"][$counter]["totalSold"] = OrderDetails::
                            leftJoin("order_master", "order_master.order_id", "=", "order_details.order_id")
                            ->where("order_details.fg_cat_id", $fgValues["id"])
                            ->where("order_master.order_by_id", $request->session()->get("userID"))
                            ->where("order_master.order_dispatch_status", 1)
                            ->whereMonth("order_master.order_date", Carbon::now()->month)
                            ->whereYear("order_master.order_date", Carbon::now()->year)
                            ->sum("order_details.fg_quantity");

                        $counter++;
                    }
                }

                // echo "<pre>";print_r($data);die();
                return view("dashboard.salesDash", $data);
            }
        } 
 
    }

    public function getProductionStatus() {
        $productionLine = ProductionLineMaster::select("id", "line_name")
            ->where("is_active", 1)
            ->get()->toArray();

        $totalStock = [];
        if ($productionLine) {
            $pCounter = 0;
            foreach ($productionLine as $pLine) {

                $productionLineStatus[$pCounter]["counter"] = $pLine;
                $productionLineStatus[$pCounter]["productionData"] = ProductionTimerMaster::
                    select(
                        "production_timer_master.id",
                        "production_timer_master.counter_id",
                        "production_timer_master.fgId",
                        "production_timer_master.production_start_time",
                        "production_timer_master.production_line_id",
                        "production_timer_master.production_timer_seconds",
                        "fg_cat_bottle_html.main_id",
                        "fg_cat_bottle_html.main_class",
                        "fg_cat_bottle_html.sub_class",
                        "fg_cat_bottle_html.inner_class",
                        "fg_cat_bottle_html.max_capacity"
                    )
                    ->leftJoin("fg_cat_bottle_html", "fg_cat_bottle_html.fg_cat_id", "=", "production_timer_master.fgId")
                    ->where("production_timer_master.production_status", 1)
                    ->where("production_timer_master.production_line_id", $pLine["id"])
                    ->first();

                $fgCatData = FgCatMaster::select("id", "fg_cat_name")
                    ->where("production_line_id", $pLine["id"])
                    ->get()->toArray();
                 
                $pCounter++;    
                    
                $counter = 0;    
                foreach ($fgCatData as $fgValues) {
                    $totalStock[$pLine["id"]][$counter]["fgData"] = $fgValues;
                    $totalStock[$pLine["id"]][$counter]["productionQuantity"] = FgStockTransaction::
                        where("fg_cat_id", $fgValues["id"])
                        ->whereDate("fg_stock_transaction.created_at", Carbon::today())
                        ->sum("fg_stock_transaction.stock_quantity");
                    $counter++;
                } 

            }
        }

        $data = [
            "productionLineStatus" => $productionLineStatus,
            "totalStock" => $totalStock
        ];

        return response()->json([
            "status" => "success",
            "data" => $data
        ]);
    }

}
