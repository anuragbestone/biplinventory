<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ProductionIssueMaster;

class ProductionIssuesController extends Controller
{

    public function productionIssue() {

        $data["productionIssueData"] = ProductionIssueMaster::select("id", "production_issue_types", "is_active")
            ->where("is_active", 1)
            ->get()->toArray();

        return view("admin.productionIssue", $data);
    }

    public function productionIssueDo(Request $request) {
        $slugValue = Str::slug($request->issue_type, '_');

        $status = ProductionIssueMaster::where("issue_slug", $slugValue)
            ->exists();

        if ($status) {
            return back()->with("error", $request->issue_type." already exists!!");
        } else {
            ProductionIssueMaster::create([
                "production_issue_types" => $request->issue_type,
                "issue_slug" => $slugValue,
                "is_active" => 1
            ]);

            return back()->with("success", "Production Issue Type Added Successfully");
        }
    }

}
