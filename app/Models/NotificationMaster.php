<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMaster extends Model
{
    use HasFactory;

    protected $table = "notification_master";

    protected $fillable = [

        "route_address",
        "notification_title",
        "notification_msg",
        "is_clicked",
        "main_address",
        "for_role_id"
        
    ];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
