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
    public function addIPByUser(Request $request)
    {
        $user_id = $request->user_id;
        if($ip_validation = $request->validate([
            'ip' => 'required|ip'
        ]))
        { }
        if($user_id?User::find($user_id):User::all())
        {
            $ip = new Address();
            $ip->label = $request->label;
            $ip->ip = $request->ip;
            $ip->comment = $request->comment;
            $ip->user_id = $request->user_id;
            $result = $ip->save();

            // Save audit
            $auditSaveResult = $this->saveAudit($request, $ip, "save");

            if($result == 1 and $auditSaveResult==1)
                return response()->json(['message' => 'Ip address saved'])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
            else
                return response()->json(['message' => 'ERROR.Could not save.'])
                    ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);    
        }
        else
        {
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

    public function getIPRecordByID(Request $request, $id)
    {
        $header = $request->bearerToken();
        JWTAuth::setToken($header);
        $user_id = JWTAuth::authenticate()->id;
        $specific_record = Address::where('id',$id)->get();
        if($specific_record[0]->user_id == $user_id) {
            return response()->json([$specific_record])
                ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }
    }

    public function editIPRecordById(Request $request)
    {
        $ip = $request->ip;
        $specific_record = Address::where('id',$request->id)->get();
        $specific_record[0]->label = $request->label;
        $result = $specific_record[0]->save();
        
        // Save audit
        $auditSaveResult = $this->saveAudit($request, $ip, "save");

        if($result==1 and $auditSaveResult==1)
            return response()->json(['message' => 'saved'])
                ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        else
            return response()->json(['message' => 'ERROR.Could not edit.'])
                ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);    
    }

    public function saveAudit(Request $request, $ip, $type)
    {
        $header = $request->bearerToken();
        JWTAuth::setToken($header);
        $user_name = JWTAuth::authenticate()->name;
        $audit = new Audit();
        if($type=="save")
            $audit->text = "$user_name saved an ip adress of value: $ip->ip at $request->timestamp";
        else
            $audit->text = "$user_name edited an ip: $ip with label: $request->label at $request->timestamp";
        $audit->user_id = $request->user_id;
        $result = $audit->save();
        if($result == 1) 
            return 1;
        else 
            return 0;
    }
}
