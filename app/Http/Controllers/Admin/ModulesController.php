<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModuleMaster;

class ModulesController extends Controller
{

    public function modules() {

        $data["moduleData"] = ModuleMaster::select("id", "module_name", "module_route", "is_active")
            ->where("is_active", 1)
            ->get()->toArray(); 

        return view("admin.modules", $data);
    }

}
