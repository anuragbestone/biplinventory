<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPmStockWarehouseMaster extends Model
{
    use HasFactory;

    protected $table = "rm_pm_stock_warehouse_master";
    
    protected $fillable = [
        "rm_pm_cat_id",
        "stock_quantity"
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
