<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModuleMaster;
use App\Models\PermissionMaster;

class PermissionsController extends Controller
{
    
    public function permissions() {

        $moduleData = ModuleMaster::select("id", "module_name", "module_route")->where("is_active", 1)->get()->toArray();
        if ($moduleData) {
            $counter = 0;
            foreach ($moduleData as $mData) {
                $data["permissionData"][$counter]["moduleData"] = $mData;
                $data["permissionData"][$counter]["rolesData"] = PermissionMaster::select("role_master.role_name")
                    ->leftjoin("role_master", "role_master.id", "=", "permission_master.role_id")
                    ->where("permission_master.module_id", $mData["id"])
                    ->get()->toArray();

                $counter++;
            }
        } else {
            $data["permissionData"] = [];
        }

        // echo "<pre>";print_r($data);die();

        // return view("admin.permissions");
        return view("admin.showPermission", $data);
    }

}
