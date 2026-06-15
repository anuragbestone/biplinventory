<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPmCatMaster extends Model
{
    use HasFactory;

    protected $table = "rm_pm_cat_master";

    protected $fillable = [

        "rm_pm_id",
        "rm_pm_cat_name",
        "cat_unit"
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
