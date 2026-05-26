<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\FgCatMaster;
use App\Models\FgMaster;
use App\Models\FgStockMaster;

class ProductionReportController extends Controller
{
    public function productionReport(Request $request) {
        $filter = $request->filter ?? "7days";
        // Default values
        $days = 7;
        $groupFormat = 'Y-m-d';
    
        if ($filter == "month") {
            $days = 30;
        }
    
        if ($filter == "year") {
            $days = 365;
            $groupFormat = 'Y-m';
        }
    
        $dates = collect(range(0, $days - 1))->map(function ($i) {
            return Carbon::today()->subDays($i)->format('Y-m-d');
        })->reverse()->values()->toArray();
                
        $counter = 0;
        foreach ($dates as $d) {
            $data["productionData"][$counter]["date"] = $d;
            $data["productionData"][$counter]["data"] = FgStockMaster::select(
                "fg_cat_master.fg_cat_name",
                "fg_master.fg_name",
                "fg_stock_master.stock_quantity"
            )
            ->leftjoin("fg_cat_master", "fg_stock_master.fg_cat_id", "=", "fg_cat_master.id")
            ->leftjoin("fg_master", "fg_cat_master.fg_id", "=", "fg_master.id")
            ->wheredate("fg_stock_master.created_at", $d)
            ->get()->toArray();
            $counter++;
            
        }
        
        
    
        $data["selectedFilter"] = $filter;
        $data["productionGraphData"] = [];
        foreach ($dates as $index => $d) {
            $stockData = FgStockMaster::select(
                    "fg_cat_master.fg_cat_name",
                    "fg_master.fg_name",
                    "fg_stock_master.stock_quantity"
                )
                ->leftJoin("fg_cat_master", "fg_stock_master.fg_cat_id", "=", "fg_cat_master.id")
                ->leftJoin("fg_master", "fg_cat_master.fg_id", "=", "fg_master.id")
                ->whereDate("fg_stock_master.created_at", $d)
                ->get()
                ->toArray();
    
            $data["productionGraphData"][$index] = [
                "date" => $d,
                "data" => $stockData
            ];
        }
        
        // echo "<pre>";print_r($data);die();
        return view("admin.productionReport", $data);
    }
}
