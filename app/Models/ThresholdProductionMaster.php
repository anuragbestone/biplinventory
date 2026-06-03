<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThresholdProductionMaster extends Model
{
    use HasFactory;

    protected $table = "threshold_production_master";
    
    protected $fillable = [
        "fg_cat_id",
        "max_quantity"
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
