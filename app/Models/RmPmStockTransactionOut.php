<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPmStockTransactionOut extends Model
{
    use HasFactory;

    protected $table = "rm_pm_stock_transaction_out";

    protected $fillable = [
        "rm_pm_cat_id",
        "stock_quantity",
        "shift_from",
        "shift_to",
        "production_line_id",
        "rejection_quantity",
        "rejection_percentage",
        "uploaded_by_user_id",
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
