<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RmPmProcurementUpdateController extends Controller
{
    public function rmPmProcurementUpdate() {

        return view("admin.rmPmProcurementUpdate");
    }
}
