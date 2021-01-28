<?php

namespace Tests;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Foundation\Testing\WithFaker;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $formData = 
        [
            "name"=>"ridwan",
	        "email"=>"ridwan@email.com",
	        "password"=>"password",
	        "password_confirmation"=>"password"
        ];
        $this->withoutExceptionHandling();
        $this->post(('/api/auth/register'),$formData)
            ->assertStatus(200);
    }

    // public function test_can_login()
    // {
    //     $formData = 
    //     [
    //         "name"=>"ridwan",
	//         "email"=>"ridwan@email.com",
	//         "password"=>"password",
	//         "password_confirmation"=>"password"
    //     ];
    //     $this->withoutExceptionHandling();
    //     $this->post(('/api/auth/register'),$formData);
    //     $this->post(('/api/auth/login'),[
    //         'email'=>'ridwan@email.com',
    //         'password' => bcrypt('password'),
    //         'timestamp'=>null
    //     ])->assertStatus(200);
    //     // $this->withoutExceptionHandling();
    //     // $response->assertStatus(200);
    //     // $this->assertArrayHasKey('token',$response->json());
    //     // User::where('email','test@gmail.com')->delete();
    // }

}
