<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ShiftMaster;

class ShiftReportController extends Controller
{

    public function shiftReport() {

        $data["shiftData"] = ShiftMaster::select(
            "user_master.email",
            "shift_master.shift_from",
            "shift_master.shift_to",
            "shift_master.shift_over_status",
            "shift_master.created_at"
            )
            ->leftJoin("user_master", "user_master.id", "=", "shift_master.userID")
            ->latest("shift_master.created_at")
            ->get()->toArray();

        return view("admin.shiftReport", $data);
    }

}
