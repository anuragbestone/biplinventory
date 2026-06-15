<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FgPmFormulaMaster extends Model
{
    use HasFactory;

    protected $table = "fg_pm_formula_master";

    protected $fillable = [

        "fg_cat_id",
        "rm_pm_cat_id",
        "fg_cat_quantity",
        "rm_pm_cat_quantity",
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}