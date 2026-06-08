<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OrderMaster;
use App\Models\OrderDetails;
use App\Models\FgCatMaster;
use App\Models\SalesTargetMaster;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Models\NotificationMaster;

class OrderNDispatchController extends Controller
{

    public function orderNDispatch(Request $request) {
        $rollID = $request->session()->get("role_id");
        
        $data["orderData"] = OrderMaster::select(
                "order_master.id",
                "order_master.order_id",
                "order_master.order_date",
                "order_master.order_dispatch_date",
                "order_master.order_dispatch_date_achieved",
                "order_master.order_production_status",
                "order_master.order_dispatch_status",
                "order_master.payment_status",
                "order_master.payment_approve_status",
                "user_master.email"
            )
            ->leftjoin("user_master", "user_master.id", "=", "order_master.order_by_id")
            ->where("order_master.is_active", 1)
            ->latest("order_master.created_at")
            ->get()
            ->toArray();


        $data["fgCatData"] = FgCatMaster::select("id", "fg_cat_name")
            ->where("is_active", 1)
            ->get()->toArray();

        return view("admin.orderNDispatch", $data);
    }

    public function generateOrder(Request $request) {

        // GENERATE UNIQUE ORDER ID
        do {
            $orderID = 'ORD-'.Carbon::now()->format('YmdHis').'-'.strtoupper(Str::random(6));
        } while (
            OrderMaster::where('order_id', $orderID)->exists()
        );

        $orderStatus = OrderMaster::create([
            "order_id" => $orderID,
            "order_date" => $request->order_date,
            "order_by_id" => $request->session()->get('userID'),
            "dispatch_address" => $request->dispatch_address,
            "order_dispatch_date" => $request->dispatch_date,
            "payment_status" => $request->payment_status,
            "payment_approve_status" => 0,
            "payment_approve_by_id" => 0
        ]);

        if ($orderStatus) {

            $fgIds = FgCatMaster::select("id")->where("is_active", 1)->get()->toArray();
            foreach ($fgIds as $fId) {
                if (!empty($request->fgCat[$fId["id"]]) && ($request->fgCat[$fId["id"]] > 0)) {
                    OrderDetails::create([
                        "order_id" => $orderID,
                        "fg_cat_id" => $fId["id"],
                        "fg_quantity" => $request->fgCat[$fId["id"]],
                        "fg_unit" => "cases"
                    ]);
                }
            }
            return back()->with("success", "Order Generated Successfully");

        } else {
            return back()->with("error", "Somehting Went Wrong");
        }

    }

    public function getOrderDetailsData(Request $request) {
        $data["orderData"] = OrderMaster::select("order_id", "order_date", "order_dispatch_date", "dispatch_address")
            ->where("id", $request->orderID)
            ->first();

        $data["orderDetails"] = OrderDetails::select("fg_cat_master.fg_cat_name", "order_details.fg_quantity")
            ->leftjoin("fg_cat_master", "order_details.fg_cat_id", "fg_cat_master.id")
            ->where("order_details.order_id", $data["orderData"]->order_id)
            ->get()->toArray();

        if ($data["orderData"]) {
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

    public function updatePaymentStatus(Request $request) {

        if ($request->has("payment_status") && $request->input("payment_status") == 1) {
            OrderMaster::where("id", $request->input("order_id"))->update([
                "payment_status" => 1
            ]);

            $order_id = OrderMaster::select("order_id")->where("id", $request->input("order_id"))->first();

            NotificationMaster::create([
                "route_address" => "notification",
                "main_address" => "orderNDispatch",
                "notification_title" => "Payment Status Updated",
                "notification_msg" => "Order Code: ".$order_id->order_id,
                "is_clicked" => 0
            ]);

            return back()->with("success", "Payment Status Changed, Waiting For Approval");

        } else {

            return back()->with("error", "Payment Status Not Updated");

        }
    }

    public function approvePayment(Request $request) {
        if ($request->has("payment_status") && $request->input("payment_status") == 1) {

            OrderMaster::where("id", $request->input("order_id"))->update([
                "payment_approve_status" => 1,
                "payment_approved_by_id" => $request->session()->get("userID")
            ]);

            $order_id = OrderMaster::select("order_id")->where("id", $request->input("order_id"))->first();

            // ------ Get Total Cases
            $totalCases = OrderDetails::where("order_id", $order_id->order_id)->sum("fg_quantity");

            // -------- Update The Target Sales Starts
            $salesUserData = OrderMaster::select("order_by_id", "order_date")
                ->where("order_id", $order_id->order_id)
                ->first();

            if ($salesUserData) {
                $currentAchievedData = SalesTargetMaster::select("achieved_target_quantity", "id")
                    ->where("user_id", $salesUserData->order_by_id)
                    ->whereMonth("target_date", Carbon::parse($salesUserData->order_date)->format("m"))
                    ->whereYear("target_date", Carbon::parse($salesUserData->order_date)->format("Y"))
                    ->first();
                    
                if ($currentAchievedData) {
                    SalesTargetMaster::where("id", $currentAchievedData->id)
                        ->update([
                            "achieved_target_quantity" => $currentAchievedData->achieved_target_quantity + $totalCases
                        ]);
                }
            }
            // -------- Update The Target Sales Ends

            NotificationMaster::create([
                "route_address" => "notification",
                "main_address" => "orderNDispatch",
                "notification_title" => "Payment Approved",
                "notification_msg" => "Order Code: ".$order_id->order_id,
                "is_clicked" => 0
            ]);

            return back()->with("success", "Payment Approved Successfully");

        } else {
            return back()->with("error", "Payment Status Not Updated");
        }
    }

}
