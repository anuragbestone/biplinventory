<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmPmStockTransactionIn;
use App\Models\RmPmMaster;
use App\Models\RmPmCatMaster;
use App\Models\RmPmStockMaster;
use App\Models\RmPmStockWarehouseTransactionMaster;
use App\Exports\StockReportExport;
use Maatwebsite\Excel\Facades\Excel;

class StockReportController extends Controller
{

    public function stockReport() {
        
        // --- last 7 days
        $dates = collect(range(0, 6))->map(function ($i) {
                    return Carbon::today()->subDays($i)->format('Y-m-d');
                })->toArray();
                
        $counter = 0;
        foreach ($dates as $d) {
            $dailyStockTransactionInData[$counter]["date"] = $d;
            $dailyStockTransactionInData[$counter]["data"] = RmPmStockTransactionIn::select(
                    "rm_pm_stock_transaction_in.id", 
                    "rm_pm_cat_master.rm_pm_cat_name",
                    "rm_pm_cat_master.cat_unit",
                    "rm_pm_master.rm_pm_name",
                    "rm_pm_stock_transaction_in.stock_quantity",
                    "rm_pm_stock_transaction_in.shift_from",
                    "rm_pm_stock_transaction_in.shift_to",
                    "production_line_master.line_name",
                    "rm_pm_stock_transaction_in.created_at")
                ->leftjoin("rm_pm_cat_master", "rm_pm_stock_transaction_in.rm_pm_cat_id", "=", "rm_pm_cat_master.id")
                ->leftjoin("rm_pm_master", "rm_pm_cat_master.rm_pm_id", "=", "rm_pm_master.id")
                ->leftjoin("production_line_master", "rm_pm_stock_transaction_in.production_line_id", "=", "production_line_master.id")
                ->where("rm_pm_stock_transaction_in.is_active", 1)
                ->wheredate("rm_pm_stock_transaction_in.created_at", $d)
                ->get()->toarray();   
            $counter++;
        }
        
        $data["dailyStockTransactionData"] = $dailyStockTransactionInData;
        return view("admin.stockreport", $data);
    }

    public function rmPmWarehouseStock() {
        $rmPmData = RmPmMaster::select("id", "rm_pm_name", "rm_pm_image")
            ->where("is_active", 1)
            ->get()->toArray();

        if ($rmPmData) {
            $rmPmStockWiseData = [];
            $counter = 0;

            foreach ($rmPmData as $rData) {
                $rmPmStockWiseData[$counter] = $rData;
                $rmPmStockWiseData[$counter]["rcData"] = RmPmCatMaster::select(
                        "rm_pm_cat_master.rm_pm_cat_name", 
                        "rm_pm_cat_master.cat_unit", 
                        "rm_pm_stock_warehouse_master.stock_quantity"
                    )
                    ->leftjoin("rm_pm_stock_warehouse_master", "rm_pm_cat_master.id", "=", "rm_pm_stock_warehouse_master.rm_pm_cat_id")
                    ->where("rm_pm_cat_master.rm_pm_id", $rData["id"])
                    ->get()->toArray();
                $counter++;
            }
        }

        $dates = collect(range(0, 6))->map(function ($i) {
                    return Carbon::today()->subDays($i)->format('Y-m-d');
                })->toArray();

        $counter = 0;
        foreach ($dates as $d) {
            $dailyStockWarehouseData[$counter]["date"] = $d;
            $dailyStockWarehouseData[$counter]["data"] = RmPmStockWarehouseTransactionMaster::select(
                "rm_pm_cat_master.rm_pm_cat_name",
                "rm_pm_cat_master.cat_unit",
                "rm_pm_master.rm_pm_name",
                "rm_pm_stock_warehouse_transaction_master.stock_quantity",
                "rm_pm_stock_warehouse_transaction_master.token_id"
            )
            ->rightjoin("rm_pm_cat_master", "rm_pm_stock_warehouse_transaction_master.rm_pm_cat_id", "=", "rm_pm_cat_master.id")
            ->leftjoin("rm_pm_master", "rm_pm_cat_master.rm_pm_id", "=", "rm_pm_master.id")
            ->where("rm_pm_stock_warehouse_transaction_master.is_active", 1)
            ->wheredate("rm_pm_stock_warehouse_transaction_master.created_at", $d)
            ->get()->toarray();
            $counter++;
        }

        $data["rmPmStockWiseData"] = $rmPmStockWiseData;
        $data["dailyStockWarehouseData"] = $dailyStockWarehouseData;

        // echo "<pre>";print_r($data);die();
        return view("admin.stockreportWarehouse", $data);
    }

    public function stockReportExcel()
    {
        return Excel::download(
            new StockReportExport,
            "stock_report.xlsx"
        );
    }

}
