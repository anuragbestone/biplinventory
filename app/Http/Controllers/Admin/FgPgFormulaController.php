<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FgPmFormulaMaster;
use App\Models\RmPmMaster;
use App\Models\RmPmCatMaster;
use App\Models\FgMaster;
use App\Models\FgCatMaster;

class FgPgFormulaController extends Controller {

    public function showfgPmFormula() {

        $data["fgData"] = FgCatMaster::select("fg_cat_master.id", "fg_cat_master.fg_cat_name", "fg_master.fg_name")
            ->leftjoin("fg_master", "fg_master.id", "=", "fg_cat_master.fg_id")
            ->where("fg_cat_master.is_active", 1)
            ->get()->toArray();

        $data["rmPmData"] = RmPmMaster::select("id", "rm_pm_name")
            ->where("is_active", 1)
            ->get()->toArray();

        return view("admin.fgPmFormula", $data);
    }

    public function getRmPmCatDataByID(Request $request) {
        $rmPmCatData = RmPmCatMaster::select("id", "rm_pm_cat_name")
            ->where("rm_pm_cat_master.rm_pm_id", $request->rmPmId)
            ->get()->toArray();

        if ($rmPmCatData) {
            
            $rData = [];
            $counter = 0;
            foreach ($rmPmCatData as $rCData) {
                $formulaData = FgPmFormulaMaster::select("rm_pm_cat_quantity")
                    ->where("rm_pm_cat_id", $rCData["id"])
                    ->where("fg_cat_id", $request->fgCatId)
                    ->first();

                $rData[$counter] = $rCData;
                if ($formulaData) {
                    $rData[$counter]["rm_pm_cat_quantity"] = $formulaData->rm_pm_cat_quantity; 
                } else {
                    $rData[$counter]["rm_pm_cat_quantity"] = null;
                }

                $counter++;
            }

            $data = [
                "status" => "success",
                "rmPmCatData" => $rData,
                "rmPmName" => RmPmMaster::select("rm_pm_name")->where("id", $request->rmPmId)->first()->rm_pm_name
            ];
        } else {
            $data = [
                "status" => "error"
            ];
        }

        return response()->json($data);
    } 

    public function fgPmFormulaUpload(Request $request) {
        $formulaData = FgPmFormulaMaster::select("id")
            ->where("fg_cat_id", $request->fg_cat_id)
            ->where("rm_pm_cat_id", array_key_first($request->rmSelected))
            ->first();

        if ($formulaData) {
            FgPmFormulaMaster::where("id", $formulaData->id)
                ->update([
                    "fg_cat_id" => $request->fg_cat_id,
                    "rm_pm_cat_id" => array_key_first($request->rmSelected),
                    "fg_cat_quantity" => 1,
                    "rm_pm_cat_quantity" => $request->quantity[array_key_first($request->rmSelected)]    
                ]);
        } else {
            FgPmFormulaMaster::create([
                "fg_cat_id" => $request->fg_cat_id,
                "rm_pm_cat_id" => array_key_first($request->rmSelected),
                "fg_cat_quantity" => 1,
                "rm_pm_cat_quantity" => $request->quantity[array_key_first($request->rmSelected)]
            ]);
        }

        return back()->with("success", "Fg Formula Uploaded");
    }

}
