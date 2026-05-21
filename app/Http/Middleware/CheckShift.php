<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Services\WhatsAppService;
use App\Models\ShiftMaster;
use Carbon\Carbon;

class CheckShift
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $shiftData = ShiftMaster::select("id", "shift_from", "shift_to", "shift_over_status")
            ->where("userID", $request->session()->get('userID'))
            ->latest("id")
            ->first();

        if($shiftData) {

            if ($shiftData->shift_over_status == 1) {

                return redirect()->route("dashboard")
                    ->with("kindly submit the shift!!");

            } else {

                $currentTime = Carbon::now("Asia/Kolkata");
                $shiftTo = Carbon::parse($shiftData->shift_to, "Asia/Kolkata");
                $shiftFrom = $shiftData->shift_from;

                if($currentTime->greaterThan($shiftTo)) {

                    ShiftMaster::where("id", $shiftData->id)
                        ->update([
                            "shift_over_status" => 1
                        ]);

                    $request->session()->forget("shift_from");
                    $request->session()->forget("shift_to");

                    $whatsapp = app(WhatsAppService::class);

                    $message =
                        "*".$request->session()->get("full_name")."'s Shift Ended* \n\n".
                        "*Shift From:* ".Carbon::parse($shiftFrom)->format("l, d F Y h:i A")."\n".
                        "*Shift To:* ".Carbon::parse($shiftTo)->format("l, d F Y h:i A");

                    $response = $whatsapp->sendMessage(
                        "919311676180",
                        $message
                    );

                    return redirect()->route("dashboard")
                        ->with("kindly submit the shift!!");

                } else {

                    return $next($request);

                }
            }

        } else {

            return redirect()->route("dashboard")
                ->with("kindly submit the shift!!");

        }
    }
}