<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModuleMaster;
use App\Models\PermissionMaster;
use App\Models\RoleMaster;

class PermissionsController extends Controller
{
    
    public function permissions() {

        $data["moduleData"] = ModuleMaster::select("id", "module_name", "module_route")->where("is_active", 1)->get()->toArray();
        if ($data["moduleData"]) {
            $counter = 0;
            foreach ($data["moduleData"] as $mData) {
                $data["permissionData"][$counter]["moduleData"] = $mData;
                $data["permissionData"][$counter]["rolesData"] = PermissionMaster::select("role_master.role_name")
                    ->leftjoin("role_master", "role_master.id", "=", "permission_master.role_id")
                    ->where("permission_master.module_id", $mData["id"])
                    ->get()->toArray();

                $counter++;
            }

            $data["roleData"] = RoleMaster::select("id", "role_name")
                ->where("is_active", 1)
                ->get()->toArray();

        } else {
            $data["permissionData"] = [];
        }

        // echo "<pre>";print_r($data);die();

        // return view("admin.permissions");
        return view("admin.showPermission", $data);
    }

    public function getRelatedRoleByModuleID(Request $request) {
        $roleData = PermissionMaster::select("role_id")
            ->where("module_id", $request->input("module_id"))
            ->get()->toArray();

        if ($roleData) {
            $data = [
                "status" => "success",
                "role_data" => $roleData,
                "message" => "Role Data Found"
            ];
        } else {    
            $data = [
                "status" => "error",
                "message" => "Role ID Not Found"
            ];
        }

        return response()->json($data);
    }

    public function updateModulePermission(Request $request) {
        if ($request->has("role_id")) {

            foreach ($request->input("role_id") as $role_values) {
                
            }

        } else {
            return back()->with("error", "No Route Given");
        }
    }

}
