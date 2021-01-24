<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

    }//end __construct()

    public function login(Request $request)
    {
        error_log($request);
        $validator = Validator::make(
            $request->all(),
            [
                'email'    => 'required|email',
                'password' => 'required|string|min:6',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $token_validity = (24);

        $this->guard()->factory()->setTTL($token_validity);

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json(['error' => 'Email or password doesn\'t exist'], 401);
        }
        JWTAuth::setToken($token);
        $user_name = JWTAuth::authenticate()->name;
        $user_id = JWTAuth::authenticate()->id;
        error_log($user_name);
        $audit = new Audit();
        $ldate = date('Y-m-d H:i:s');
        error_log($ldate);
        $audit->text = "$user_name has logged in at $ldate";
        $audit->user_id = $user_id;
        $result = $audit->save();

        return $this->respondWithToken($token);

    }//end login()

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required|string|between:2,100',
                'email'    => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        $user = User::create(
            array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            )
        );

        return response()->json(['message' => 'User created successfully', 'user' => $user]);

    }//end register()

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'User logged out successfully']);

    }//end logout()

    public function profile()
    {
        return response()->json($this->guard()->user());

    }//end profile()

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());

    }//end refresh()

    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'token'          => $token,
                'token_type'     => 'bearer',
                'token_validity' => ($this->guard()->factory()->getTTL() * 60),
                'id' => $this->guard()->user()->id,
                'name' => $this->guard()->user()->name,
                'email' => $this->guard()->user()->email
            ]
        );
    }//end respondWithToken()

    protected function guard()
    {
        return Auth::guard();

    }//end guard()

}