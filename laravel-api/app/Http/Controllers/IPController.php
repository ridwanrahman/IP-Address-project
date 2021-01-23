<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Address;
use App\Models\Audit;
use Illuminate\Support\Facades\Log;

use Tymon\JWTAuth\Facades\JWTAuth;

class IPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }//end __construct()

    //

    //Add specific user's ip address
    public function addIP(Request $request)
    {
        error_log("addign ip");
        $user_id = $request->user_id;

        if($ip_validation = $request->validate([
            'ip' => 'required|ip'
        ]))
        {
            error_log("ip address is fine");
        }
        if($user_id?User::find($user_id):User::all())
        {
            error_log("user with this id exists");
            $ip = new Address();
            $ip->label = $request->label;
            $ip->ip = $request->ip;
            $ip->comment = $request->comment;
            $ip->user_id = $request->user_id;
            $result = $ip->save();
            
            // Save audit
            $header = $request->bearerToken();;
            JWTAuth::setToken($header);
            $user_name = JWTAuth::authenticate()->name;
            $audit = new Audit();
            $audit->text = "$user_name saved an ip adress of value: $ip->ip at $request->timestamp";
            $audit->user_id = $request->user_id;
            $result = $audit->save();

            return response()->json(['message' => 'Ip address saved'])
                ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }
        else
        {
            error_log("ERROR");
            return response()->json(['message' => 'ERROR.'])
                ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);
        }

    }

    //get specific user's ip address
    public function getAllIPByUser(Request $request, $id)
    {
        $header = $request->bearerToken();;
        JWTAuth::setToken($header);
        $user_id = JWTAuth::authenticate()->id;
        if ($id == $user_id) {
            $useraddresses = Address::all();
            $c = collect();
            foreach($useraddresses as $ud) {
                if($ud->user_id == $id){
                    $c->add($ud);
                }
            }
            return response()->json([$c])
                ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        } else {
            return response()->json(['message' => 'You Are not authenticated to view this resource.'])
                ->setStatusCode(Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);
        }
    }


}
