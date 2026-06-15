<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThresholdRmPmMaster extends Model
{
    use HasFactory;

    protected $table = "threshold_rm_pm_master";
    
    protected $fillable = [

        "rm_pm_cat_id",
        "max_quantity",
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
