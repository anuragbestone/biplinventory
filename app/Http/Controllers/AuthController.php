<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UserMaster;

class AuthController extends Controller
{

    public function showLogin() {
        return view("pages.loginPage");
    }

    public function doLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return back()->with("validation failed")->withInput();
        } else {

            // ---- Check for email.
            $emailStatus = UserMaster::where("email", $request->input("email"))
                ->where("is_active", 1)    
                ->exists();

            if ($emailStatus) {
                $userData = UserMaster::select("id", "email", "contact_number", "full_name", "password", "role_id")
                    ->where("email", $request->input("email"))
                    ->first();

                if ($userData) {
                    // ---- Check for Password
                    if (Hash::check($request->input("password"), $userData->password)) {
                        $request->session()->put("userID", $userData->id);
                        $request->session()->put("email", $userData->email);
                        $request->session()->put("contact_number", $userData->contact_number);
                        $request->session()->put("full_name", $userData->full_name);
                        $request->session()->put("role_id", $userData->role_id);
                        return redirect()->route("dashboard")->with("success", "session started");

                    } else {
                        return back()->with("error", "password is incorrect")->withINput();
                    }
                } else {
                    return back()->with("error", "email not found")->withInput();
                }
            } else {
                return back()->with("error", "email is wrong")->withInput();
            }

        }
    }

    public function doLogout(Request $request) {
        $request->session()->flush();
        return redirect()->route("/")->with("session has ended!!");
    }

}
