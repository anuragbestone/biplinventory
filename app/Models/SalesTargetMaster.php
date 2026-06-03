<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTargetMaster extends Model
{
    use HasFactory;

    protected $table = "sales_target_master";
    
    protected $fillable = [
        "target_date",
        "target_given_date",
        "user_id",
        "target_quantity",
        "achieved_target_quantity"
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
