<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FgStockTransaction extends Model
{
    use HasFactory;

    protected $table = "fg_stock_transaction";

    protected $fillable = [

        "fg_cat_id",
        "stock_quantity",
        "production_line_id",
        "shift_from",
        "shift_to",
        "uploaded_by_id"
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
