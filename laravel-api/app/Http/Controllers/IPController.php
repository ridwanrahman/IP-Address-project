<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class IPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }//end __construct()

    //
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
