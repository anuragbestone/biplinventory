<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailMaster extends Model
{
    use HasFactory;

    protected $table = "email_master";

    protected $fillable = [

        "template_name",
        "template_slug_name",
        "email_body",
        "subject",
        "email_to_address",
        "email_from_address",
        "email_cc_address"
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
