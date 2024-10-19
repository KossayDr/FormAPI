<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use GeneralTrait;
    ## Register method
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

    //$user->makeHidden(['created_at', 'updated_at', 'first_name', 'last_name']);
        $user->token = $user->createToken('MyApp')->plainTextToken;
        return $this->buildResponse($user,'Success','register successfully', 200);
    }


    ## Login method
    public function login(LoginRequest $request)
    {

        $user =User::where('email', $request->input('email'))->first();

        if (!$user) {
            return $this->buildResponse('null', 'Error', 'not found user ', 404);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return $this->buildResponse('null', 'Error', 'please valid from email and password!', 404);
        }
        
       // $user->tokens()->delete();
        $user->token = $user->createToken('token')->plainTextToken;
             
       // $user->makeHidden(['created_at', 'updated_at', 'first_name', 'last_name','email_verified_at']);
        return $this->buildResponse($user, 'Success', 'login successfully', 200);
    }

    ## Logout method
    public function logout(){
        $user =Auth::user();
        $currentAccessToken = $user->currentAccessToken();
        $tokens = $user->tokens()->where('id', $currentAccessToken->id)->get();
        $tokens->each(function ($token) {
            $token->delete();
            });
        return $this->buildResponse(null, 'Success', 'Logged out successfully', 200);
    }
}
