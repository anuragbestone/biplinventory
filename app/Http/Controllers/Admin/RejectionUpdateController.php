<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RejectionMaster;
use App\Models\RmPmStockTransactionOut;
use App\Models\RmPmMaster;
use App\Models\RmPmCatMaster;

class RejectionUpdateController extends Controller
{
    public function rejectionUpdate() {
        $data["rejectionData"] = RejectionMaster::select(
            "id",
            "total_rejection",
            "rm_pm_stock_rejection_percentage",
            "remark",
            "shift_from",
            "shift_to",
            "approved_status",
            "created_at"
        )
        ->latest("created_at")
        ->get()->toArray();

        if ($data["rejectionData"]) {
            return view("admin.rejectionUpdate", $data);
        } else {
            return redirect()->route("dashboard")->with("error", "Rejection Data Not Found");
        }
    }

    public function rejectionUpdateDo(Request $request) {
        if ($request->exists("rejection_id")) {
            RejectionMaster::where("id", $request->rejection_id)
                ->update([
                    "approved_status" => $request->action == "approve" ? 1 : 0
                ]);

            return back()->with("success", "Rejection Updated Successfully");
        } else {
            return back()->with("error", "Wrong Rejection Update Request");
        }
    }

    public function getSingleRejectionData(Request $request) {
        $data = RejectionMaster::select(
            "rm_pm_stock_transaction_out_id",
            "rm_pm_stock_rejection_percentage",
        )
        ->where("id", $request->rejectioMasterId)
        ->first()->toArray();

        if ($data["rm_pm_stock_transaction_out_id"]) {
            $transactionIdsArr = json_decode($data["rm_pm_stock_transaction_out_id"]);
            $rejectionData = [];
            $counter = 0;
            foreach ($transactionIdsArr as $trData) {
                
                $rejectionData[$counter] = RmPmStockTransactionOut::select(
                    "rm_pm_stock_transaction_out.rm_pm_cat_id", 
                    "rm_pm_stock_transaction_out.rejection_percentage",
                    "rm_pm_cat_master.rm_pm_cat_name",
                    "rm_pm_master.rm_pm_name"
                    )
                    ->leftjoin("rm_pm_cat_master", "rm_pm_stock_transaction_out.rm_pm_cat_id", "=", "rm_pm_cat_master.id")
                    ->leftjoin("rm_pm_master", "rm_pm_cat_master.rm_pm_id", "=", "rm_pm_master.id")
                    ->where("rm_pm_stock_transaction_out.id", $trData)
                    ->first();
                $counter++;
            }

            $data = [
                "status" => "success",
                "data" => $rejectionData
            ];

        } else {
            $data = [
                "status" => "error"
            ];
        }

        return response()->json($data);
    }
}
