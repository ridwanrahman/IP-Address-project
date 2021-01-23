<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Log;

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
        if($user_id?User::find($user_id):User::all())
        {
            error_log("user with this id exists");
            $ip = new Address();
            $ip->label = $request->label;
            $ip->ip = $request->ip_address;
            $ip->comment = $request->comment;
            $ip->user_id = $request->user_id;
            $result = $ip->save();
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
    public function getIP()
    {

    }



    public function open()
    {
        $data = "I need to close this api without the access token";
        return response()->json(compact('data'),200);
    }

    public function close()
    {
        $data = "I need to close this api without access token too";
        return response()->json(compact('data'),200);
    }

    public function getUsers($id=null)
    {
        return $id?User::find($id):User::all();
    }
}
