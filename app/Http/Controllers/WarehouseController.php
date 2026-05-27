<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Services\WhatsAppService;

use App\Models\RmPmMaster;
use App\Models\RmPmCatMaster;
use App\Models\RmPmStockMaster;
use App\Models\RmPmStockTransactionIn;
use App\Models\RmPmStockTransactionOut;
use App\Models\RmPmStockInReciept;
use App\Models\RmPmStockWarehouseMaster;
use App\Models\RmPmStockWarehouseTransactionMaster;
use App\Models\FgMaster;
use App\Models\FgCatMaster;
use App\Models\FgStockMaster;
use App\Models\FgStockTransaction;
use App\Models\ProductionIssueMaster;
use App\Models\ProductionLineMaster;
use App\Models\ProductionLineDelayStatus;
use App\Models\ProductionIssueRecorded;
use App\Models\ProductionTimerMaster;
use App\Models\RejectionMaster;
use App\Models\UserMaster;
use App\Models\ShiftMaster;
use App\Models\OrderMaster;
use App\Models\OrderDetails;
use App\Models\FgDispatchMaster;
use App\Models\FgPmFormulaMaster;
use App\Models\ThresholdProductionMaster;
use App\Models\ThresholdRmPmMaster;
use App\Models\NotificationMaster;

use Illuminate\Support\Carbon;

class WarehouseController extends Controller {

    public function deleteShift(Request $request) {
        $sData = ShiftMaster::select("id", "shift_over_status")
            ->where("userID", $request->session()->get('userID'))
            ->latest()
            ->first();

        if ($sData->shift_over_status == 0) {
            ShiftMaster::where("id", $sData->id)
                ->update(["shift_over_status" => 1]);
        }

        return back();
    }

    public function updateShift(Request $request, WhatsAppService $whatsapp) {
        $shiftFrom = Carbon::parse($request->input("shift_from"));
        $shiftTo = Carbon::parse($request->input("shift_to"));


        ShiftMaster::create([
            "userID" => $request->session()->get("userID"),
            "shift_from" => $shiftFrom,
            "shift_to" => $shiftTo,
            "shift_over_status" => 0
        ]);

        $request->session()->put('shift_from', $shiftFrom);
        $request->session()->put('shift_to', $shiftTo);


        // WhatsApp Service -- Starts

        $message =
            "🟢 *SHIFT STARTED* \n\n".
            "👤 *Employee:* \n".
            $request->session()->get("full_name")."\n\n".
            "🕒 *Shift From:* \n".
            Carbon::parse($shiftFrom)
                ->format("l, d F Y h:i A")."\n\n".
            "🕔 *Shift To:* \n".
            Carbon::parse($shiftTo)
                ->format("l, d F Y h:i A")."\n\n".
            "✅ Shift has been started successfully.";

        $response = $whatsapp->sendMessage(
            "919311676180",
            $message
        );

        // dd([
        //     "status" => $response->status(),
        //     "body" => $response->body(),
        //     "json" => $response->json()
        // ]);
        // WhatsApp Service -- Ends

        NotificationMaster::create([
            "route_address" => "notification",
            "main_address" => "shiftReport",
            "notification_title" => "Shift Started",
            "notification_msg" => "Shift Details: \nFrom: ".Carbon::parse($shiftFrom)
                ->format("l, d F Y h:i A")."\nTo: ".Carbon::parse($shiftTo)
                ->format("l, d F Y h:i A"),
            "is_clicked" => 0
        ]);

        return back()->with("success", "Shift Updated Successfully");

    }

    public function profile(Request $request) {
        $data["profileData"] = UserMaster::select("full_name", "email", "contact_number", "whatsapp_contact")
            ->where("id", $request->session()->get('userID'))
            ->first();

        return view("warehouse.profile", $data);
    }

    public function getFgCatDataById(Request $request) {
        $fgCatData = FgCatMaster::select("id", "fg_cat_name")
            ->where("fg_id", $request->fgId)
            ->get()->toArray();

        return response()->json([
            "status" => "success",
            "fgCatData" => $fgCatData
        ]);
    }

    public function rmpmentryStock() {
        $rmpmData = RmPmMaster::select("id", "rm_pm_name")
            ->where("is_active", 1)
            ->get();

        foreach ($rmpmData as $rData) {
            $catData = RmPmCatMaster::select(
                    "rm_pm_cat_master.id",
                    "rm_pm_cat_master.rm_pm_cat_name",
                    "rm_pm_cat_master.cat_unit"
                )
            ->where("rm_pm_cat_master.rm_pm_id", $rData->id)
            ->where("rm_pm_cat_master.is_active", 1)
            ->get()
            ->toArray();

            $data["rmpmData"][] = [
                "id" => $rData->id,
                "rm_pm_name" => $rData->rm_pm_name,
                "catData" => $catData
            ];

        }

        return view("warehouse.rmpmentryStock", $data);
    }

    public function rmpmentryStockDo(Request $request) {
        $data = collect($request->except('_token'))->flatten();
        $hasValue = $data->contains(function ($value) {
            return !empty($value) && $value > 0;
        });

        if (!$hasValue) {
            return redirect()->back()->with("error", "Please enter at least one quantity.");
        } else {
            $rData = $request->except(['_token']);
            foreach ($rData as $key => $value) {
                if ($value && $value > 0) {
                    // ---- Upload Current Stock
                    $stockValue = RmPmStockWarehouseMaster::select("stock_quantity")
                        ->where("rm_pm_cat_id", $key)
                        ->first();

                    if ($stockValue) {
                        RmPmStockWarehouseMaster::where("rm_pm_cat_id", $key)
                            ->update([
                                "stock_quantity" => $stockValue->stock_quantity + (empty($value[0]) ? 0 : $value[0]), 
                                "is_active" => 1
                            ]);

                    } else {
                        RmPmStockWarehouseMaster::create([
                            "rm_pm_cat_id" => $key,
                            "stock_quantity" => empty($value[0]) ? 0 : $value[0]
                        ]);
                    }

                    if (!empty($value[0])) {
                        RmPmStockWarehouseTransactionMaster::create([
                            "rm_pm_cat_id" => $key,
                            "stock_quantity" => empty($value[0]) ? 0 : $value[0],
                            "added_by" => $request->session()->get('userID')
                        ]);
                    }
                }

            }
        }

        NotificationMaster::create([
            "route_address" => "notification",
            "main_address" => "stockReport/rmPmWarehouseStock",
            "notification_title" => "Rm Pm Stock Uploaded",
            "notification_msg" => "New Stocks Have Been Added",
            "is_clicked" => 0
        ]);

        return back()->with("success", "Rm / Pm Stock Uploaded To Warehouse");
    }

    public function rmpmentry(Request $request) {
        //echo "<pre>";print_r($request->all());die();
        $data["formulaData"] = [];
        if ($request->has('filter')) {
            $data["selected_production_line_id"] = $request->input("production_line_id");
            $data["fg_id"] = $request->input("fg");
            $data["fg_cat_id"] = $request->input("fg_cat");
            $data["formulaData"] = FgPmFormulaMaster::select("fg_cat_id", "rm_pm_cat_id", "rm_pm_cat_quantity")
                ->where("fg_cat_id", $data["fg_cat_id"])
                ->get()->toArray();

        } else {

            $data["selected_production_line_id"] = 0;
            $data["fg_id"] = 0;
            $data["fg_cat_id"] = 0;
        }

        $data["productionLine"] = ProductionLineMaster::select("id", "line_name")
            ->where("is_active", 1)
            ->get()
            ->toArray();

        $data["fgData"] = FgMaster::select("id", "fg_name")
            ->where("is_active", 1)
            ->get()
            ->toArray();

        $rmpmData = RmPmMaster::select("id", "rm_pm_name")
            ->where("is_active", 1)
            ->get();

        if ($rmpmData->isEmpty()) {
            return redirect()
                ->route("dashboard")
                ->with("error", "No data found");
        }

        $data["rmpmData"] = [];

        foreach ($rmpmData as $rData) {
            $catData = [];
            if (!empty($data["fg_cat_id"])) {
                $catData = RmPmCatMaster::select(
                        "rm_pm_cat_master.id",
                        "rm_pm_cat_master.rm_pm_cat_name",
                        "rm_pm_cat_master.cat_unit",
                        "rm_pm_stock_warehouse_master.stock_quantity as max_quantity"
                    )
                    ->leftJoin(
                        "fg_pm_formula_master",
                        "rm_pm_cat_master.id",
                        "=",
                        "fg_pm_formula_master.rm_pm_cat_id"
                    )
                    ->leftJoin(
                        "rm_pm_stock_warehouse_master",
                        "rm_pm_stock_warehouse_master.rm_pm_cat_id",
                        "=",
                        "rm_pm_cat_master.id"
                    )
                    ->where("fg_pm_formula_master.fg_cat_id", $data["fg_cat_id"])
                    ->where("rm_pm_cat_master.rm_pm_id", $rData->id)
                    ->where("rm_pm_cat_master.is_active", 1)
                    ->get()
                    ->toArray();
            }

            $data["rmpmData"][] = [
                "id" => $rData->id,
                "rm_pm_name" => $rData->rm_pm_name,
                "catData" => $catData
            ];
        }

        //echo "<pre>";print_r($data);die();
        return view("warehouse.rmpmentry", $data);
    }

    public function rmpmentryDo(Request $request, WhatsAppService $whatsapp) {
        $data = collect($request->except('_token'))->flatten();
        $hasValue = $data->contains(function ($value) {
            return !empty($value) && $value > 0;
        });

        if (!$hasValue) {
            return redirect()->back()->with("error", "Please enter at least one quantity.");
        } else {
            $shift_from = Carbon::parse($request->input("shift_from"));
            $shift_to = Carbon::parse($request->input("shift_to"));
            $rData = $request->except(['_token', "shift_from", "shift_to", "production_line_id"]);
            $whatsAppDetailMessage = "";
            foreach ($rData as $key => $value) {
                
                // ---- Remove From Stock Warehouse Master
                $stockValue = RmPmStockWarehouseMaster::select("stock_quantity")
                    ->where("rm_pm_cat_id", $key)
                    ->first();

                if ($stockValue) {
                    RmPmStockWarehouseMaster::where("rm_pm_cat_id", $key)
                        ->update(["stock_quantity" => $stockValue->stock_quantity - (empty($value[0]) ? 0 : $value[0]), "is_active" => 1]);
                }

                // ---- Upload Current Stock
                $stockValue = RmPmStockMaster::select("stock_quantity")
                    ->where("rm_pm_cat_id", $key)
                    ->first();

                if ($stockValue) {
                    RmPmStockMaster::where("rm_pm_cat_id", $key)
                        ->update(["stock_quantity" => $stockValue->stock_quantity + (empty($value[0]) ? 0 : $value[0]), "is_active" => 1]);
                } else {
                    
                    RmPmStockMaster::create([
                        "rm_pm_cat_id" => $key,
                        "stock_quantity" => empty($value[0]) ? 0 : $value[0]
                    ]);
                }

                if (!empty($value[0])) {
                    RmPmStockTransactionIn::create([
                        "rm_pm_cat_id" => $key,
                        "stock_quantity" => empty($value[0]) ? 0 : $value[0],
                        "shift_from" => $shift_from,
                        "shift_to" => $shift_to,
                        "production_line_id" => $request->production_line_id,
                        "uploaded_by_user_id" => $request->session()->get('userID')
                    ]);
                }

                if (!empty($value[0])) {
                    $rmpmWData = RmPmCatMaster::select("rm_pm_cat_master.rm_pm_cat_name", "rm_pm_cat_master.cat_unit", "rm_pm_master.rm_pm_name")
                        ->join("rm_pm_master", "rm_pm_master.id", "=", "rm_pm_cat_master.rm_pm_id")
                        ->where("rm_pm_cat_master.id", $key)
                        ->first();

                    $whatsAppDetailMessage .=
                        "▪️ *".$rmpmWData->rm_pm_cat_name."*\n".
                        "   ".$rmpmWData->rm_pm_name."\n".
                        "   Qty: *".$value[0]." ".$rmpmWData->cat_unit."*\n\n";
                }
            }

            // WhatsApp Service -- Starts
            $message =
                "📦 *RM/PM STOCK ADDED* \n\n".
                "👤 *Uploaded By:* \n".
                $request->session()->get("full_name")."\n\n".
                "🕒 *Shift From:* \n".
                Carbon::parse(
                    $request->session()->get("shift_from")
                )->format("d F Y h:i A")."\n\n".
                "🕔 *Shift To:* \n".
                Carbon::parse(
                    $request->session()->get("shift_to")
                )->format("d F Y h:i A")."\n\n".
                "📋 *Stock Details:* \n".
                "━━━━━━━━━━━━━━\n".
                $whatsAppDetailMessage.
                "━━━━━━━━━━━━━━\n\n".
                "✅ Inventory stock updated successfully.";

            $response = $whatsapp->sendMessage(
                "919311676180",
                $message
            );
            // WhatsApp Service -- Ends

            NotificationMaster::create([
                "route_address" => "notification",
                "main_address" => "stockReport",
                "notification_title" => "Rm Pm Stock Procured",
                "notification_msg" => "New Stocks Have Been Procured",
                "is_clicked" => 0
            ]);

            return back()->with("success", "Rm / Pm Stock Updated Successfully!!!");
        }
    }

    public function updateProductionTime(Request $request, WhatsAppService $whatsapp) {
        $lineName = ProductionLineMaster::where(
            "id",
            $request->input("production_line_id")
            )->value("line_name");

        if ($request->production_status == "start") {

            NotificationMaster::create([
                "route_address" => "notification",
                "main_address" => "dashboard",
                "notification_title" => "Production Has Been Started At ".Carbon::now()->format("d F Y h:i A"),
                "notification_msg" => "Production Started At ".$lineName,
                "is_clicked" => 0
            ]);
            
            ProductionTimerMaster::create([
                "production_line_id" => $request->input("production_line_id"),
                "shift_from" => $request->session()->get("shift_from"),
                "shift_to" => $request->session()->get("shift_to"),
                "counter_id" => $request->counter_id,
                "fgId" => $request->fg_id,
                "production_start_time" => Carbon::now(),
                "production_line_id" => $request->input("production_line_id"),
                "production_timer_seconds" => 300,
                "production_status" => 1
            ]);
            
            // WhatsApp Service -- Starts

            // $message =
            //     "🏭 *PRODUCTION STARTED* \n\n".
            //     "📍 *Production Line:* \n".
            //     "*".$lineName."*\n\n".
            //     "🕒 *Start Time:* \n".
            //     Carbon::now()->format(
            //         "d F Y h:i A"
            //     )."\n\n".
            //     "⚙️ Production activity has started successfully.";

            // $response = $whatsapp->sendMessage(
            //     "919311676180",
            //     $message
            // );

            // WhatsApp Service -- Ends

            return response()->json([
                "status" => "success",
                "data" => [
                    "production_time" => Carbon::now(),
                    "production_timer_seconds" => 300
                ]
            ]);

        }

        if ($request->production_status == "stop") {

        }

    }

    public function getProductionTimerUpdate() {
        $productionData = ProductionTimerMaster::select(
            "counter_id",
            "fgId",
            "production_start_time",
            "production_stop_time",
            "production_timer_seconds",
            "production_line_id",
            "production_status"
        )
        ->where("production_status", 1)
        ->get();

        if ($productionData) {

            $data = [
                "status" => "success",
                "productionData" => $productionData
            ];
        } else {
            $data = [
                "status" => "error",
                "productionData" => []
            ];
        }

        return response()->json($data);

    }

    public function stopProductionTimer(Request $request, WhatsAppService $whatsapp) {
        // GET LINE NAME
        $lineName = ProductionLineMaster::where(
            "id",
            $request->input("production_line_id")
        )->value("line_name");

        // WhatsApp Service -- Starts

        $message =
            "🔴 *PRODUCTION STOPPED* \n\n".
            "📍 *Production Line:* \n".
            "*".$lineName."*\n\n".
            "🕒 *Stop Time:* \n".
            Carbon::now()->format(
                "d F Y h:i A"
            )."\n\n".
            "⛔ Production activity has been stopped.";

        $response = $whatsapp->sendMessage(
            "919311676180",
            $message
        );

        // WhatsApp Service -- Ends
    }


    public function production() {
        $data["productionIssueData"] = ProductionIssueMaster::select("id", "production_issue_types")
            ->where("is_active", 1)
            ->get()->toArray();
        $data["productionLineData"] = ProductionLineMaster::select("id", "line_name")
            ->where("is_active", 1)
            ->get()->toArray();

        if ($data["productionLineData"]) {
            $counter = 0;
            foreach ($data["productionLineData"] as $pData) {
                $data["productionDelayFlags"][$pData["id"]] = ProductionLineDelayStatus::where("production_line_id", $pData["id"])
                    ->where("line_status", 1)
                    ->exists() ? 1 : 0;

                $data["productionLineData"][$counter] = $pData;
                $data["productionLineData"][$counter]["fg"] = FgCatMaster::select(
                            "fg_cat_master.id", 
                            "fg_cat_master.fg_cat_name",
                            "threshold_production_master.max_quantity"
                        )
                    ->leftjoin("threshold_production_master", "threshold_production_master.fg_cat_id", "=", "fg_cat_master.id")
                    ->where("fg_cat_master.production_line_id", $pData["id"])
                    ->where("fg_cat_master.is_active", 1)
                    ->get()->toArray();

                $counter++;
            }
        } else {
            return redirect()->route("dashboard")->with("error", "production line not found");
        }

        // echo "<pre>";print_r($data);die();
        return view("warehouse.production", $data);
    }

    public function uploadProduction(Request $request, WhatsAppService $whatsapp) {
        try {
            $shiftFrom = Carbon::parse($request->shift_from);
            $shiftTo = Carbon::parse($request->shift_to);
            $productionLineId = $request->productionLine;
            $qtyData = $request->qty;

            // VALIDATE QTY EXISTS
            if(empty($qtyData))
            {
                return response()->json([
                    "status" => "error",
                    "message" => "No quantity found"
                ]);
            }

            $whatsAppProductionDetails = "";
            foreach($qtyData as $fgId => $qty)
            {
                // SKIP EMPTY OR ZERO QTY
                if(empty($qty) || $qty <= 0)
                {
                    continue;
                }

                // CHECK STOCK
                $fgStockStatus = FGStockMaster::select(
                        "id",
                        "stock_quantity"
                    )
                    ->where("fg_cat_id", $fgId)
                    ->first();

                // UPDATE STOCK
                if($fgStockStatus)
                {
                    FGStockMaster::where("fg_cat_id", $fgId)
                        ->update([
                            "stock_quantity" =>
                                $fgStockStatus->stock_quantity + $qty
                        ]);
                }
                else
                {
                    FGStockMaster::create([
                        "fg_cat_id" => $fgId,
                        "stock_quantity" => $qty
                    ]);
                }

                // INSERT TRANSACTION
                FGStockTransaction::create([
                    "fg_cat_id" => $fgId,
                    "stock_quantity" => $qty,
                    "production_line_id" => $productionLineId,
                    "shift_from" => $shiftFrom,
                    "shift_to" => $shiftTo,
                    "uploaded_by_id" =>
                        $request->session()->get('userID')
                ]);

                $fgWData = FgCatMaster::select("fg_cat_master.fg_cat_name", "fg_master.fg_name")
                    ->join("fg_master", "fg_master.id", "=", "fg_cat_master.fg_id")
                    ->where("fg_cat_master.id", $fgId)
                    ->first();

                    $whatsAppProductionDetails .=
                        "▪️ *".$fgWData->fg_cat_name."*\n".
                        "   ".$fgWData->fg_name."\n".
                        "   Produced Qty: *".$qty." KG*\n\n";

            }

            // GET LINE NAME
            $lineName = ProductionLineMaster::where(
                "id",
                $productionLineId
            )->value("line_name");

            // WhatsApp Service -- Starts
            $message =
                "🏭 *PRODUCTION UPDATE* \n\n".
                "📍 *Production Line:* \n".
                "*".$lineName."*\n\n".
                "👤 *Updated By:* \n".
                $request->session()->get("full_name")."\n\n".
                "🕒 *Shift From:* \n".
                Carbon::parse(
                    $request->session()->get("shift_from")
                )->format("d F Y h:i A")."\n\n".
                "🕔 *Shift To:* \n".
                Carbon::parse(
                    $request->session()->get("shift_to")
                )->format("d F Y h:i A")."\n\n".
                "📋 *Production Details:* \n".
                "━━━━━━━━━━━━━━\n".
                $whatsAppProductionDetails.
                "━━━━━━━━━━━━━━\n\n".
                "✅ Production stock updated successfully.";

            $response = $whatsapp->sendMessage(
                "919311676180",
                $message
            );

            // WhatsApp Service -- Ends

            return response()->json([
                "status" => "ok",
                "message" => "Production uploaded successfully"
            ]);

        }
        catch(\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function productionDelayAlert(Request $request, WhatsAppService $whatsapp) {
        $request->validate([
            'production_line_id' => 'required|integer|exists:production_line_master,id'
        ]);

        $productionLineId = $request->production_line_id;

        // Check For Existing Alert
        $delayStatus = ProductionLineDelayStatus::where("production_line_id", $productionLineId)
            ->where("line_status", 1)
            ->exists();

        if (!$delayStatus) {
            // Store delay status
            ProductionLineDelayStatus::create([
                "production_line_id" => $productionLineId,
                "line_status" => 1
            ]);

            // Fetch line name safely
            $line = ProductionLineMaster::select("line_name")
                        ->where("id", $productionLineId)
                        ->first();

            $lineName = $line ? $line->line_name : "Unknown Line";

            // WhatsApp Message

            $message =
                "🚨 *PRODUCTION TIME EXCEEDED* 🚨 \n\n".
                "📍 *Production Line:* \n".
                "*{$lineName}*\n\n".
                "👤 *Reported By:* \n".
                $request->session()->get("full_name")."\n\n".
                "🕒 *Shift From:* \n".
                Carbon::parse(
                    $request->session()->get("shift_from")
                )->format("d F Y h:i A")."\n\n".
                "🕔 *Shift To:* \n".
                Carbon::parse(
                    $request->session()->get("shift_to")
                )->format("d F Y h:i A")."\n\n".
                "⚠️ Production time limit has been exceeded.\n".
                "Kindly check and upload the production issue reason immediately.";

            // Send WhatsApp
            $response = $whatsapp->sendMessage(
                "919311676180",
                $message
            );
        }

        // Optional failure handling
        // if (!$response || $response->failed()) {
        //     return response()->json([
        //         "status" => "error",
        //         "message" => "WhatsApp alert failed"
        //     ], 500);
        // }

        return response()->json([
            "status" => "ok",
            "message" => "Delay alert received",
            "production_line_id" => $productionLineId
        ]);
    }

    public function productionIssueUpload(Request $request, WhatsAppService $whatsapp) {
        ProductionIssueRecorded::create([
            "production_line_id" => $request->input("production_line_id"),
            "production_type_id" => $request->input("issue_type_id"),
            "summary" => $request->input("summary"),
            "added_by_id" => $request->session()->get("userID")
        ]);

        ProductionLineDelayStatus::where("production_line_id", $request->input("production_line_id"))
            ->where("line_status", 1)
            ->update([
                "line_status" => 0
        ]);

        ProductionTimerMaster::where("production_line_id", $request->production_line_id)
            ->where("production_status", 1)
            ->update([
                "production_status" => 0,
                "production_stop_time" => Carbon::now()
            ]);

        // Fetch line name safely
        $line = ProductionLineMaster::select("line_name")
                    ->where("id", $request->input("production_line_id"))
                    ->first();

        $lineName = $line ? $line->line_name : "Unknown Line";

        $issue = ProductionIssueMaster::select("production_issue_types")
            ->where("id", $request->input("issue_type_id"))
            ->first();

        $issueName = $issue ? $issue->production_issue_types : "Unknown Issue";

        // WhatsApp Message
        $message =
            "🛠️ *PRODUCTION ISSUE REMARK SUBMITTED* \n\n".
            "📍 *Production Line:* \n".
            "*{$lineName}*\n\n".
            "👤 *Reported By:* \n".
            $request->session()->get("full_name")."\n\n".
            "🕒 *Shift From:* \n".
            Carbon::parse(
                $request->session()->get("shift_from")
            )->format("d F Y h:i A")."\n\n".
            "🕔 *Shift To:* \n".
            Carbon::parse(
                $request->session()->get("shift_to")
            )->format("d F Y h:i A")."\n\n".
            "⚠️ *Issue Type:* \n".
            "*".$issueName."*\n\n".
            "📝 *Reason / Remark:* \n".
            $request->input("summary")."\n\n".
            "✅ Production issue remark uploaded successfully.";

        // Send WhatsApp
        $response = $whatsapp->sendMessage(
            "919311676180",
            $message
        );

        // Optional failure handling
        // if (!$response || $response->failed()) {
        //     return response()->json([
        //         "status" => "error",
        //         "message" => "WhatsApp alert failed"
        //     ], 500);
        // }

        return redirect()->route("warehouse/production")->with("Production Line Issue Recorded");
    }

    public function rmpmstock() {
        return view("warehouse.rmpmstock");
    }

    public function fgstock() {
        return view("warehouse.fgstock");
    }

    public function rejection(Request $request) {
        $data["filter"] = 0;

        // ---- Filter Hit Starts
        if ($request->has('filter')) {
            $data["selected_production_line_id"] = $request->input("production_line_id");
            $data["fg_id"] = $request->input("fg");
            $data["fg_cat_id"] = $request->input("fg_cat");
            $data["formulaData"] = FgPmFormulaMaster::select("fg_cat_id", "rm_pm_cat_id", "rm_pm_cat_quantity")
                ->where("fg_cat_id", $data["fg_cat_id"])
                ->get()->toArray();

        } else {
            $data["selected_production_line_id"] = 0;
            $data["fg_id"] = 0;
            $data["fg_cat_id"] = 0;
        }
        // ---- Filter Hit Ends
        
        $data["fgData"] = FgMaster::select("id", "fg_name")
            ->where("is_active", 1)
            ->get()
            ->toArray();

        $data["fgData"] = FgMaster::select("id", "fg_name")
            ->where("is_active", 1)
            ->get()
            ->toArray();

        $data["productionLine"] = ProductionLineMaster::select("id", "line_name")
            ->where("is_active", 1)
            ->get()->toArray();

        $rmpmData = RmPmMaster::select("id", "rm_pm_name")
            ->where("is_active", 1)
            ->get()->toArray();
        if (!empty($data["fg_cat_id"])) {
            if ($rmpmData) {
                $counter = 0;
                foreach ($rmpmData as $rData) {
                        $data["rmpmData"][$counter] = $rData;
                        $data["rmpmData"][$counter]["catData"] = RmPmCatMaster::select("rm_pm_cat_master.id",
                            "rm_pm_cat_master.rm_pm_cat_name", 
                            "rm_pm_cat_master.cat_unit",
                            "rm_pm_stock_master.stock_quantity"
                            )
                            ->leftjoin("rm_pm_stock_master", "rm_pm_stock_master.rm_pm_cat_id", "=", "rm_pm_cat_master.id")
                            ->leftJoin(
                                "fg_pm_formula_master",
                                "rm_pm_cat_master.id",
                                "=",
                                "fg_pm_formula_master.rm_pm_cat_id"
                            )
                            ->where("fg_pm_formula_master.fg_cat_id", $data["fg_cat_id"])
                            ->where("rm_pm_cat_master.is_active", 1)
                            ->where("rm_pm_cat_master.rm_pm_id", $rData["id"])
                            ->get()->toArray();
                        $counter++;
                }

                $data["filter"] = 1;
            } else {
                return redirect()->route("dashboard")->with("error", "data not found!!!");
            }
        }
        return view("warehouse.rejection", $data);
    }

    public function uploadRejection(Request $request, WhatsAppService $whatsapp) {
        //echo "<pre>";print_r($request->all());die();
        $shiftFrom = Carbon::parse($request->input("shift_from"));
        $shiftTo = Carbon::parse($request->input("shift_to"));

        if (count($request->input("catId")) > 0) {
            if (intval($request->total_rejection) > 0) {
                $rm_pm_cat_id = [];
                $rm_pm_stock_rejection = [];
            }

            $whatsAppDetailMessage = "";
            $totalRejection = 0;
            $rejectionCount = 0;
            foreach ($request->input("catId") as $cValues => $values) {
                if (!empty($values)) {
                    $rmpmStockStatus = RmPmStockMaster::select("stock_quantity")
                        ->where("rm_pm_cat_id", $cValues)
                        ->first();
                    if ($rmpmStockStatus) {
                        RmPmStockMaster::where("rm_pm_cat_id", $cValues)->update([
                            "stock_quantity" => $rmpmStockStatus->stock_quantity - (!empty($values) ? $values : 0)
                        ]);

                        $stockOut = RmPmStockTransactionOut::create([
                            "rm_pm_cat_id" => $cValues,
                            "stock_quantity" => $values,
                            "rejection_quantity" => !empty($request->input("rejectionCat")[$cValues]) ? $request->input("rejectionCat")[$cValues] : 0,
                            "rejection_percentage" => $request->input("rejection_percentage")[$cValues],
                            "shift_from" => $shiftFrom,
                            "shift_to" => $shiftTo,
                            "uploaded_by_user_id" => $request->session()->get("userID")
                        ]);

                        $totalRejection = $totalRejection + floatval($request->input("rejection_percentage")[$cValues]);
                        $rejectionCount = $rejectionCount + 1;

                        if (!empty($request->total_rejection)) {
                            $rm_pm_cat_id[] = $stockOut->id;
                            $rm_pm_stock_rejection[] = $request->input("rejection_percentage")[$cValues];
                        }

                        if (!empty($request->input("rejectionCat")[$cValues])) {
                            $rmpmWData = RmPmCatMaster::select("rm_pm_cat_master.rm_pm_cat_name", "rm_pm_cat_master.cat_unit", "rm_pm_master.rm_pm_name")
                            ->join("rm_pm_master", "rm_pm_master.id", "=", "rm_pm_cat_master.rm_pm_id")
                            ->where("rm_pm_cat_master.id", $cValues)
                            ->first();

                            $whatsAppDetailMessage .=
                                "▪️ *".$rmpmWData->rm_pm_cat_name."*\n".
                                "   ".$rmpmWData->rm_pm_name."\n".
                                "   Used Qty: *".$values." ".$rmpmWData->cat_unit."*\n".
                                "   Rejection Qty: *".$request->input("rejectionCat")[$cValues]." ".$rmpmWData->cat_unit."*\n".
                                "   Rejection %: *".$request->input("rejection_percentage")[$cValues]."*\n\n";
                        
                        }

                    }
                }
            }

            if (floatval(str_replace('%', '', $request->total_rejection)) > 1) {
                RejectionMaster::create([
                    "rm_pm_stock_transaction_out_id" => json_encode($rm_pm_cat_id),
                    "rm_pm_stock_rejection_percentage" => json_encode($rm_pm_stock_rejection),
                    "total_rejection" => $request->input("total_rejection"),
                    "remark" => $request->filled("remark") ? $request->input("remark") : "No Remark Given",
                    "shift_from" => $request->session()->get("shift_from"),
                    "shift_to" => $request->session()->get("shift_to"),
                    "production_line_id" => $request->production_line_id,
                    "added_by" => $request->session()->get("userID"),
                    "approved_status" => 0
                ]);
            }

            NotificationMaster::create([
                "route_address" => "notification",
                "main_address" => "rejectionUpdate",
                "notification_title" => "Rejection Added",
                "notification_msg" => "Rejection Details: \nTotal Rejection: ".($totalRejection / $rejectionCount),
                "is_clicked" => 0
            ]);

            // WhatsApp Service -- Starts
            $message =
                "📉 *RM/PM STOCK USED* \n\n".
                "👤 *Updated By:* \n".
                $request->session()->get("full_name")."\n\n".
                "🕒 *Shift From:* \n".
                Carbon::parse(
                    $request->session()->get("shift_from")
                )->format("d F Y h:i A")."\n\n".
                "🕔 *Shift To:* \n".
                Carbon::parse(
                    $request->session()->get("shift_to")
                )->format("d F Y h:i A")."\n\n".
                "⚠️ *Total Rejection:* \n".
                "*".$request->input("total_rejection")."*\n\n".
                "📝 *Remark:* \n".
                ($request->filled("remark")
                    ? $request->input("remark")
                    : "No Remark Given")."\n\n".

                "📋 *Usage Details:* \n".
                "━━━━━━━━━━━━━━\n".
                $whatsAppDetailMessage.
                "━━━━━━━━━━━━━━\n\n".
                "✅ RM/PM stock consumption updated successfully.";

            $response = $whatsapp->sendMessage(
                "919311676180",
                $message
            );

            // dd([
            //     "status" => $response->status(),
            //     "body" => $response->body(),
            //     "json" => $response->json()
            // ]);
            // WhatsApp Service -- Ends

            return back()->with("success", "Rejection Added Successfully");

        } else {
            return back()->with("error", "no data filled!!!");
        }
    }

    public function addOrderDev(WhatsAppService $whatsapp) {
        // GENERATE UNIQUE ORDER ID
        do {
            $orderID = 'ORD-'.Carbon::now()->format('YmdHis').'-'.strtoupper(Str::random(6));
        } while (
            OrderMaster::where('order_id', $orderID)->exists()
        );
        
        OrderMaster::create([
            "order_id" => $orderID,
            "order_date" => Carbon::now(),
            "order_by_id" => 2,
            "dispatch_address" => "UTC Sector 132, Noida. Pincode: 210311",
            "order_dispatch_date" => Carbon::now()->addDay(),
            "order_production_status" => 0,
            "order_dispatch_status" => 0,
            "is_active" => 1
        ]);

        $orderData[0] = [
            "order_id" => $orderID,
            "fg_cat_id" => 2,
            "fg_quantity" => 10,
        ];
        
        $orderData[1] = [
            "order_id" => $orderID,
            "fg_cat_id" => 1,
            "fg_quantity" => 5,
        ];

        $orderData[2] = [
            "order_id" => $orderID,
            "fg_cat_id" => 3,
            "fg_quantity" => 200,
        ];

        $whatsAppDetailMessage = "";
        foreach ($orderData as $oD) {
            OrderDetails::create($oD);
            $fgData = FgCatMaster::select("fg_cat_master.fg_cat_name", "fg_master.fg_name")
                ->join("fg_master", "fg_cat_master.fg_id", "=", "fg_master.id")
                ->where("fg_cat_master.id", $oD["fg_cat_id"])
                ->first();

            $whatsAppDetailMessage .=
                "▪️ *".$fgData->fg_cat_name."*\n".
                "   ".$fgData->fg_name."\n".
                "   Qty: *".$oD["fg_quantity"]." Cases*\n\n";
        }

        // WhatsApp Service -- Starts

        $message =
            "📦 *NEW ORDER GENERATED* \n\n".
            "🆔 *Order ID:* \n".
            $orderID."\n\n".
            "📅 *Order Date:* \n".
            Carbon::now()->format("d F Y")."\n\n".
            "🚚 *Dispatch Date:* \n".
            Carbon::now()->addDay()->format("d F Y")."\n\n".
            "📍 *Dispatch Address:* \n".
            "UTC Sector 132, Noida\n".
            "Pincode: 210311\n\n".
            "📋 *Order Details:* \n".
            "━━━━━━━━━━━━━━\n".
            $whatsAppDetailMessage.
            "━━━━━━━━━━━━━━\n\n".
            "✅ Kindly process the order.";

        $response = $whatsapp->sendMessage(
            "919311676180",
            $message
        );


        // dd([
        //     "status" => $response->status(),
        //     "body" => $response->body(),
        //     "json" => $response->json()
        // ]);
        // WhatsApp Service -- Ends

        return back()->with("success", "Random Order Generated");

    }

    public function order() {
        $orderData = OrderMaster::select(
            "id", 
            "order_id", 
            "order_date", 
            "dispatch_address",
            "order_dispatch_date",
            "order_production_status",
            "order_dispatch_status",
        )->where("is_active", 1)
        ->latest("created_at")
        ->get()->toArray();

        if ($orderData) {
            $counter = 0;
            foreach ($orderData as $oData) {
                $data["orderData"][$counter]["order"] = $oData;
                $data["orderData"][$counter]["details"] = OrderDetails::select(
                        "order_details.fg_quantity",
                        "fg_cat_master.fg_cat_name",
                        "fg_master.fg_name"
                    )
                    ->leftjoin("fg_cat_master", "fg_cat_master.id", "=", "order_details.fg_cat_id")
                    ->leftjoin("fg_master", "fg_cat_master.fg_id", "=", "fg_master.id")
                    ->where("order_details.order_id", $oData["order_id"])
                    ->get()->toArray();
                $counter++;
            }

            //echo "<pre>";print_r($data);die();
            return view("warehouse.order", $data);

        } else {
            return redirect()->route("dashboard")->with("error", "No Orders Found");
        }
    }

    public function getOrderDetailsDataByOrderCode(Request $request) {
        $data["orderDetails"] = OrderDetails::select(
                "fg_cat_master.fg_cat_name",
                "order_details.fg_cat_id",
                "order_details.fg_quantity"
                )
                ->leftjoin("fg_cat_master", "order_details.fg_cat_id", "fg_cat_master.id")
                ->where("order_details.order_id", $request->orderID)
                ->get()->toArray();

        if ($data) {
            $data = [
                "status" => "success",
                "data" => $data
            ];
        } else {
            $data = [
                "status" => "error"
            ];
        }

        return response()->json($data);
    }

    public function dispatchOrder(Request $request) {
        if ($request->dispatch_status == "completed") {
            $orderedFG = OrderDetails::select("fg_cat_id", "fg_quantity")
                ->where("order_id", $request->input("order_id"))
                ->get()->toArray();

            if ($orderedFG) {
                $totalCases = 0;
                foreach ($orderedFG as $oValues) {
                    // ----- Update FG Stock Master
                    $stockQuantity = FgStockMaster::select("stock_quantity")->where("fg_cat_id", $oValues["fg_cat_id"])->first();

                    FgStockMaster::where("fg_cat_id", $oValues["fg_cat_id"])
                        ->update([
                            "stock_quantity" => $stockQuantity->stock_quantity - $request->fgCatId[$oValues["fg_cat_id"]]
                        ]);

                    // ----- Update Fg Dispatched Master
                    FgDispatchMaster::create([
                        "order_id" => $request->input("order_id"),
                        "fg_cat_id" => $oValues["fg_cat_id"],
                        'fg_quantity' => $request->fgCatId[$oValues["fg_cat_id"]],
                    ]);

                    $totalCases = $totalCases + $request->fgCatId[$oValues["fg_cat_id"]];
                }

                OrderMaster::where("order_id", $request->input("order_id"))
                    ->update([
                        "order_production_status" => 1,
                        "order_dispatch_status" => 1,
                        "order_dispatch_date_achieved" => Carbon::now()->format("Y-m-d")
                    ]);

                NotificationMaster::create([
                    "route_address" => "notification",
                    "main_address" => "orderNDispatch",
                    "notification_title" => "Order Dispatched",
                    "notification_msg" => "Order Details: \nTotal Cases: ".$totalCases."\n",
                    "is_clicked" => 0
                ]);

                return back()->with("success", "Order Dispatched Successfully");

            } else {
                return back()->with("error", "FG Not Found!!!");
            }
        } else {
            return back()->with("error", "No Changes Made");
        }
        
    }

}
