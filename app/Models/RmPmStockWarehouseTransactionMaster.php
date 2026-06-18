<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPmStockWarehouseTransactionMaster extends Model
{
    use HasFactory;

    protected $table = "rm_pm_stock_warehouse_transaction_master";
    
    protected $fillable = [
        "rm_pm_cat_id",
        "token_id",
        "stock_quantity",
        "added_by"
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
