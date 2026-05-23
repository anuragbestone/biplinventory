<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MailController extends Controller
{

    public function showMailPage()
    {

        // $cpanelHost = env('CPANEL_HOST');
        // $cpanelUser = env('CPANEL_USERNAME');
        // $cpanelToken = env('CPANEL_TOKEN');

        // $email = "test@inventory.meestdrive.in";

        /*
        CREATE SESSION USING OLD API
        */

        // $response = Http::withoutVerifying()
        //     ->withHeaders([
        //         'Authorization' => 'cpanel ' . $cpanelUser . ':' . $cpanelToken,
        //     ])
        //     ->get(
        //         $cpanelHost .
        //         '/json-api/create_user_session',
        //         [
        //             'api.version' => 1,
        //             'user' => $cpanelUser,
        //             'service' => 'webmail',
        //             'app' => 'roundcube',
        //             'email' => $email,
        //         ]
        //     );

        // dd(
        //     $response->status(),
        //     $response->body()
        // );

        return view("pages.usermail");

    }
}