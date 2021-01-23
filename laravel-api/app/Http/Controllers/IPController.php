<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

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
        error_log($request);
        // if($id?User::find($id):User::all())
        // {
        //     error_log("user with this id exists");
        //     return "user with this id exists";
        // }
        // else
        // {
        //     error_log("ERROR");
        //     return response()->json(['message' => 'ERROR.'])
        //         ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);
        // }


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
