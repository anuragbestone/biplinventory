<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SalesTargetMaster;

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
        echo "<pre>";print_r($request->all());die();
    }

}
