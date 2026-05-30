<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserMaster;

class SalesController extends Controller
{
    public function showProfile(Request $request) {
        $data["profileData"] = UserMaster::select("full_name", "email", "contact_number", "whatsapp_contact")
            ->where("id", $request->session()->get('userID'))
            ->first();

        return view("sales.profile", $data);
    }
}
