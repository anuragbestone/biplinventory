<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserMaster;

class ProfileController extends Controller
{

    public function getProfileData(Request $request) {
        $data["profileData"] = UserMaster::select("full_name", "email", "contact_number", "whatsapp_contact")
            ->where("id", $request->session()->get("userID"))
            ->first()->toArray();

        return view("admin.profile", $data);
    }

}
