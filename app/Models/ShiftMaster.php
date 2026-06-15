<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftMaster extends Model
{
    use HasFactory;

    protected $table = "shift_master";
    
    protected $fillable = [

        "userID",
        "shift_from",
        "shift_to",
        "shift_over_status"
        
    ];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
