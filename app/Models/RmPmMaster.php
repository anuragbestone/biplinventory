<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPmMaster extends Model
{
    use HasFactory;

    protected $table = "rm_pm_master";

    protected $fillable = [

        "rm_pm_name",
        "rm_pm_image",
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
