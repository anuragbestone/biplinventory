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

class DashboardController extends Controller
{
    public function showDashboard(Request $request) {
        if ($request->session()->get("role_id") != 3) {
            return view("dashboard.adminDash");
        }

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
    }
}
