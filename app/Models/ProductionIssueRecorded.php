<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionIssueRecorded extends Model
{
    use HasFactory;

    protected $table = "production_issue_recorded";

    protected $fillable = [

        "production_line_id",
        "production_type_id",
        "summary",
        "added_by_id"
        
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];
}
