<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RoleMaster;
use App\Models\UserMaster;

class UserRolesController extends Controller
{

    public function userRole() {

        $data["roleData"] = RoleMaster::select("id", "role_name", "is_active")
            ->where("is_active", 1)
            ->get()->toArray(); 

        return view("admin.userRole", $data);
    }

    public function getUserDetailsOfRoleId(Request $request) {

        $userList = UserMaster::select("full_name", "email")
            ->where("role_id", $request->roleID)
            ->get()
            ->toarray();

        if ($userList) {
            $data = [
                "status" => "success",
                "userList" => $userList
            ];
        } else {
            $data = [
                "status" => "error"
            ];
        }

        return response()->json($data);

    }

}
