<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FgStockMaster extends Model
{
    use HasFactory;

    protected $table = "fg_stock_master";

    protected $fillable = [

        "fg_cat_id",
        "stock_quantity"
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
