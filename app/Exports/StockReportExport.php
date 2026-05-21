<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table("rm_pm_stock_transaction_in")
            ->select(
                "rm_pm_master.rm_pm_name",
                "rm_pm_cat_master.rm_pm_cat_name",
                "rm_pm_cat_master.cat_unit",
                "rm_pm_stock_transaction_in.stock_quantity",
                "rm_pm_stock_transaction_in.shift_from",
                "rm_pm_stock_transaction_in.shift_to",
                "rm_pm_stock_transaction_in.created_at"
            )
            ->leftJoin(
                "rm_pm_cat_master",
                "rm_pm_stock_transaction_in.rm_pm_cat_id",
                "=",
                "rm_pm_cat_master.id"
            )
            ->leftJoin(
                "rm_pm_master",
                "rm_pm_cat_master.rm_pm_id",
                "=",
                "rm_pm_master.id"
            )
            ->whereBetween(
                "rm_pm_stock_transaction_in.created_at",
                [
                    now()->subDays(7)->startOfDay(),
                    now()->endOfDay()
                ]
            )
            ->orderBy(
                "rm_pm_stock_transaction_in.created_at",
                "DESC"
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            "Category",
            "Type",
            "Unit",
            "Quantity",
            "Shift From",
            "Shift To",
            "Created At"
        ];
    }
}