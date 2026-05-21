<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    public function sendMessage($phone, $message)
    {
        $token = env('WHATSAPP_TOKEN');
        $phoneNumberId = env('WHATSAPP_PHONE_NUMBER_ID');
        $version = env('WHATSAPP_VERSION', 'v22.0');

        $url =
            "https://graph.facebook.com/" .
            $version .
            "/" .
            $phoneNumberId .
            "/messages";

        return Http::withToken($token)
            ->post($url, [
                "messaging_product" => "whatsapp",
                "to" => $phone,
                "type" => "text",
                "text" => [
                    "body" => $message
                ]
            ]);

        // return Http::withToken($token)
        //     ->post($url, [
        //         "messaging_product" => "whatsapp",
        //         "to" => $phone,
        //         "type" => "template",
        //         "template" => [
        //             "name" => "hello_world",
        //             "language" => [
        //                 "code" => "en_US"
        //             ]
        //         ]
        //     ]);
    }
}