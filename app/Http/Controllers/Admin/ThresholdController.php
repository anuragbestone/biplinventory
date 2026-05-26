<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RmPmCatMaster;
use App\Models\RmPmMaster;
use App\Models\ThresholdProductionMaster;
use App\Models\ThresholdRmPmMaster;
use App\Models\FgCatMaster;

class ThresholdController extends Controller
{

    public function showPage() {

        $rmpmData = RmPmMaster::select("id", "rm_pm_name")
            ->where("is_active", 1)
            ->get();

        foreach ($rmpmData as $rData) {
            $catData = RmPmCatMaster::select(
                    "rm_pm_cat_master.id",
                    "rm_pm_cat_master.rm_pm_cat_name",
                    "rm_pm_cat_master.cat_unit",
                    "threshold_rm_pm_master.max_quantity"
                )
                ->leftjoin("threshold_rm_pm_master", "threshold_rm_pm_master.rm_pm_cat_id", "=", "rm_pm_cat_master.id")
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

        $data["fgCatData"] = FgCatMaster::select("fg_cat_master.id", "fg_cat_master.fg_cat_name", "fg_master.fg_name", "threshold_production_master.max_quantity")
            ->leftjoin("fg_master", "fg_cat_master.fg_id", "=", "fg_master.id")
            ->leftjoin("threshold_production_master", "threshold_production_master.fg_cat_id", "=", "fg_cat_master.id")
            ->where("fg_cat_master.is_active" , 1)
            ->get()->toArray();

        return view("admin.threshold", $data);
    }

    public function updateThresholdRmPm(Request $request) {
        $data = collect($request->except('_token'))->flatten();
        $hasValue = $data->contains(function ($value) {
            return !empty($value) && $value > 0;
        });

        if (!$hasValue) {
            return redirect()->back()->with("error", "Please enter at least one quantity.");
        } else {
            $rData = $request->except(['_token']);
            foreach ($rData as $key => $value) {
                $valueStatus = ThresholdRmPmMaster::select("id")
                    ->where("rm_pm_cat_id", $key)
                    ->first();

                if ($valueStatus) {
                    ThresholdRmPmMaster::where("rm_pm_cat_id", $key)
                        ->update([
                            "max_quantity" => !empty($value[0]) ? $value[0] : 0
                        ]);
                } else {
                    ThresholdRmPmMaster::create([
                        "rm_pm_cat_id" => $key,
                        "max_quantity" => !empty($value[0]) ? $value[0] : 0
                    ]);
                }
            }

            return back()->with("success", "Max Quantity Updated!!!");
        }
    }   

    public function updateThresholdProduction(Request $request) {
        $data = collect($request->except('_token'))->flatten();
        $hasValue = $data->contains(function ($value) {
            return !empty($value) && $value > 0;
        });

        if (!$hasValue) {
            return redirect()->back()->with("error", "Please enter at least one quantity.");
        } else {
            $fData = $request->except(['_token']);
            foreach ($fData as $key => $value) {
                $valueStatus = ThresholdProductionMaster::select("id")
                    ->where("fg_cat_id", $key)
                    ->first();

                if ($valueStatus) {
                    ThresholdProductionMaster::where("fg_cat_id", $key)
                        ->update([
                            "max_quantity" => !empty($value[0]) ? $value[0] : 0
                        ]);
                } else {
                    ThresholdProductionMaster::create([
                        "fg_cat_id" => $key,
                        "max_quantity" => !empty($value[0]) ? $value[0] : 0
                    ]);
                }
            }
        }

        return back()->with("success", "Max Quantity Updated!!!");
    }

}
