<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FgCatBottleHtml extends Model
{
    use HasFactory;

    protected $table = "fg_cat_bottle_html";

    protected $fillable = [
        "fg_cat_id",
        "main_id",
        "main_class",
        "sub_class",
        "inner_class",
        "bottle_image",
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
