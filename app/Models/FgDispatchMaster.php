<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FgDispatchMaster extends Model
{
    use HasFactory;

    protected $table = "fg_dispatched_master";

    protected $fillable = [
        "order_id",
        "fg_cat_id",
        "fg_quantity"
    ];

    protected $casts = [
        "dispatched_status" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
