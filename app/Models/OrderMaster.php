<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    use HasFactory;

    protected $table = "order_master";

    protected $fillable = [
        "order_id",
        "order_date",
        "order_by_id",
        "dispatch_address",
        "order_dispatch_date",
        "order_dispatch_date_achieved",
        "order_production_status",
        "order_dispatch_status",
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
