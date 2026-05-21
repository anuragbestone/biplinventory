<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShiftMaster;

use App\Models\RmPmMaster;
use App\Models\RmPmCatMaster;
use App\Models\RmPmStockMaster;

use App\Models\FgMaster;
use App\Models\FgCatMaster;
use App\Models\FgStockMaster;

class DashboardController extends Controller
{
    public function showDashboard(Request $request) {
       
        if ($request->session()->get("role_id") == 3) {

            // ---- Warehouse Dashboard Starts 
            $rmPmData = RmPmMaster::select("id", "rm_pm_name")
                ->where("is_active", 1)
                ->get()
                ->toArray();

            if ($rmPmData) {
                $counter = 0;
                foreach ($rmPmData as $rData) {
                    $data["rmpmData"][$counter] = $rData;
                    $rcData = RmPMCatMaster::select("id", "rm_pm_cat_name", "cat_unit")
                        ->where("rm_pm_id", $rData["id"])
                        ->get()->toArray();

                    $rcounter = 0;
                    foreach ($rcData as $rcD) {
                        $data["rmpmData"][$counter]["rcData"][$rcounter]["rm_pm_cat_name"] = $rcD["rm_pm_cat_name"];
                        $data["rmpmData"][$counter]["rcData"][$rcounter]["cat_unit"] = $rcD["cat_unit"];
                        $data["rmpmData"][$counter]["rcData"][$rcounter]["stock_quantity"] = RmPmStockMaster::select("stock_quantity")
                            ->where("rm_pm_cat_id", $rcD["id"])
                            ->first()->stock_quantity;

                        $rcounter++;
                    }

                    $counter++;
                }
            }

            $fgData = FgMaster::select("id", "fg_name")
                ->where("is_active", 1)
                ->get()->toArray();

            if ($fgData) {
                $counter = 0;
                foreach ($fgData as $fData) {
                    $data["fgData"][$counter] = $fData;
                    $fgcData = FgCatMaster::select("id", "fg_cat_name")
                        ->where("fg_id", $fData["id"])
                        ->get()->toArray();
                        
                    $rcounter = 0;
                    foreach ($fgcData as $fgD) {
                        $data["fgData"][$counter]["fgcData"][$rcounter]["fg_cat_name"] = $fgD["fg_cat_name"];
                        $data["fgData"][$counter]["fgcData"][$rcounter]["stock_quantity"] = FgStockMaster::where("fg_cat_id", $fgD["id"])
                            ->value("stock_quantity") ?? 0;

                        $rcounter++;
                    }

                    $counter++;
                }
            }

            $data["shiftData"] = ShiftMaster::select("shift_from", "shift_to", "shift_over_status")
                ->where("userID", $request->session()->get("userID"))
                ->latest()
                ->first();

            if (!empty($data["shiftData"])) {
                if ($data["shiftData"]->shift_over_status == 0) {
                    if(!($request->session()->has('shift_from'))) {
                        $request->session()->put('shift_from', $data["shiftData"]->shift_from);
                        $request->session()->put('shift_to', $data["shiftData"]->shift_to);
                    }
                } else {
                    if ($request->session()->has('shift_from')) {
                        $request->session()->forget('shift_from');
                        $request->session()->forget('shift_to');
                    }
                }
            }
            
            // ---- Warehouse Dashboard Ends

            return view("dashboard.warehouseDash", $data);
        } else {
            // ---- Admin Dashboard Starts

            return view("dashboard.adminDash");
            // ---- Admin Dashboard Ends
        }

        // echo "<pre>";print_r($data);die();
    }
}
