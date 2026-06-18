<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLineDelayStatus extends Model
{
    use HasFactory;

    protected $table = "production_line_delay_status";

    protected $fillable = [
        "production_line_id",
        "line_status"
    ];

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
