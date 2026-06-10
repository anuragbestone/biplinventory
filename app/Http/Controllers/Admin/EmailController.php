<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserMaster;
use App\Models\EmailMaster;

class EmailController extends Controller
{

    public function email() {

        $data["userData"] = UserMaster::select("id", "full_name", "email")
            ->where("is_active", 1)
            ->get()->toArray();

        $emailData = EmailMaster::select(
                "template_name",
                "template_slug_name",
                "email_body",
                "subject",
                "email_to_address",
                "email_from_address",
                "email_cc_address",
            )->where("is_active", 1)
            ->get()->toArray();

        if ($emailData) {
            $counter = 0;
            foreach ($emailData as $emailValues) {

                $data["emailTemplateData"][$counter]["template_name"] = $emailValues["template_name"];
                $data["emailTemplateData"][$counter]["template_slug_name"] = $emailValues["template_slug_name"];
                $data["emailTemplateData"][$counter]["email_body"] = $emailValues["email_body"];
                $data["emailTemplateData"][$counter]["subject"] = $emailValues["subject"];
                $data["emailTemplateData"][$counter]["email_to_address_id"] = $emailValues["email_to_address"];
                $data["emailTemplateData"][$counter]["email_to_address"] = UserMaster::select("email")->where("id", $emailValues["email_to_address"])->first()->email_to_address;
                $data["emailTemplateData"][$counter]["email_from_address_id"] = $emailValues["email_from_address"];
                $data["emailTemplateData"][$counter]["email_from_address"] = UserMaster::select("email")->where("id", $emailValues["email_from_address"])->first()->email_from_address;
                $data["emailTemplateData"][$counter]["email_cc_address_ids"] = $emailValues["email_cc_address"];
                $data["emailTemplateData"][$counter]["email_cc_address"] = [];
                
            }
        } else {
            $data["emailTemplateData"] = [];
        }

        return view("admin.email", $data);
    }

    public function generateEmailTemplate() {
        echo "<pre>";print_r($request->all());die();
    }

}
