<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Audit;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuditController extends Controller
{
    // This function takes in the request object and returns the user's audits
    public function getAuditByUserID(Request $request)
    {
        $header = $request->bearerToken();
        JWTAuth::setToken($header);
        $user_id = JWTAuth::authenticate()->id;
        $userAudits = Audit::where('user_id',$user_id)->orderBy('id', 'DESC')->get();
        return response()->json([$userAudits])
                ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    }
}
