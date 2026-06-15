<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FgCatMaster extends Model
{
    use HasFactory;

    protected $table = "fg_cat_master";

    protected $fillable = [

        "fg_id",
        "production_line_id",
        "fg_cat_name"
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
