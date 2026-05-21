<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPmStockInReciept extends Model
{
    use HasFactory;

    protected $table = "rm_pm_stock_in_reciept";

    protected $fillable = [
        "rm_pm_stock_in_ids",
        "reciept_file"
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
