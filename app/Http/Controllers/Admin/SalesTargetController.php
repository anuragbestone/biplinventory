<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SalesTargetMaster;
use App\Models\UserMaster;

use Illuminate\Support\Carbon;

class SalesTargetController extends Controller
{

    public function getSalesTargetData(Request $request) {

        $data["userData"] = UserMaster::select("id", "full_name", "email")
            ->where("is_active", 1)
            ->where("role_id", 4)
            ->get()->toArray();

        if ($request->filter) {

        } else {

            $data["salesData"] = SalestargetMaster::select(
                "sales_target_master.id",
                "sales_target_master.target_date",
                "sales_target_master.target_given_date",
                "sales_target_master.target_quantity",
                "sales_target_master.achieved_target_quantity",
                "user_master.full_name"
            )
            ->leftJoin("user_master", "user_master.id", "=", "sales_target_master.user_id")
            ->latest("sales_target_master.created_at")
            ->get()->toArray();
        
        }

        return view("admin.salesTarget", $data);
    }

    public function generateTarget(Request $request) {
        // echo "<pre>";print_r($request->all());die();

        // ------- Check For Target Month
        $monthStatus = SalesTargetMaster::whereMonth("target_date", date("m", strtotime($request->target_date)))
            ->whereYear("target_date", date("Y", strtotime($request->target_date)))
            ->where("user_id", $request->user_id)
            ->exists();

        if ($monthStatus) {
            $currentQuantityData = SalesTargetMaster::select("id", "target_quantity")
                ->where("user_id", $request->user_id)
                ->whereMonth("target_date", date("m", strtotime($request->target_date)))
                ->whereYear("target_date", date("Y", strtotime($request->target_date)))
                ->first()->toArray();

            SalesTargetMaster::where("id", $currentQuantityData["id"])
                ->update([
                    "target_date" => $request->target_date,
                    "target_given_date" => Carbon::now(),
                    "target_quantity" => $currentQuantityData["target_quantity"] + $request->target_quantity,
                ]);

            return back()->with("success", "Target Updated");

        } else {
            SalesTargetMaster::create([
                "target_date" => $request->target_date,
                "target_given_date" => Carbon::now(),
                "user_id" => $request->user_id,
                "target_quantity" => $request->target_quantity,
                "achieved_target_quantity" => 0
            ]);

            return back()->with("success", "New Target Created");
        }
    }

}
