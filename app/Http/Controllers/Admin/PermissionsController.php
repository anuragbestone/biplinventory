<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    
    public function permissions() {

        $data = [];
        // return view("admin.permissions");
        return view("admin.showPermission", $data);
    }

}
