<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPmStockMaster extends Model
{
    use HasFactory;

    protected $table = "rm_pm_stock_master";
    
    protected $fillable = [
        "rm_pm_cat_id",
        "stock_quantity",
        "is_active"
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "uploaded_at" => "datetime"
    ];
}
