<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FgMaster extends Model
{
    use HasFactory;

    protected $table = "fg_master";

    protected $fillable = [

        "fg_name",
        "fg_image_link"
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
