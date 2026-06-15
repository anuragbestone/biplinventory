<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionTimerMaster extends Model
{
    use HasFactory;

    protected $table = "production_timer_master";

    protected $fillable = [

        "shift_from",
        "shift_to",
        "counter_id",
        "fgId",
        "production_start_time",
        "production_stop_time",
        "production_line_id",
        "production_timer_seconds",
        "production_status",
        
    ];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
