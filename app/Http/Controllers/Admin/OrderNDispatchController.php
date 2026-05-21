<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OrderMaster;
use App\Models\OrderDetails;
use App\Models\FgCatMaster;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OrderNDispatchController extends Controller
{

    public function orderNDispatch() {

        $data["orderData"] = OrderMaster::select(
                "id",
                "order_id", 
                "order_date", 
                "order_dispatch_date", 
                "order_dispatch_date_achieved", 
                "order_production_status",
                "order_dispatch_status"
            )
            ->where("is_active", 1)
            ->latest("created_at")
            ->get()->toArray();


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

}
