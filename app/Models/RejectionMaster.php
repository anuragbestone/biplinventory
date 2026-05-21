<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectionMaster extends Model
{
    use HasFactory;

    protected $table = "rejection_master";

    protected $fillable = [
        "rm_pm_stock_transaction_out_id",
        "rm_pm_stock_rejection_percentage",
        "total_rejection",
        "remark",
        "shift_from",
        "shift_to",
        "added_by",
        "approved_status"
    ];

    protected $casts = [
        "created_at",
        "updated_at"
    ];
}
