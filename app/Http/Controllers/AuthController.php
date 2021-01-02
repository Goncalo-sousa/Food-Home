<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\Register;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Register $request)
    {
        $data = array_merge($request->validated(), array(
            'password' => bcrypt($request->password), 'type' => 'C'
        ));

        $user = User::create($data);

        $user->customer()->create($data);

        return new UserResource($user);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if(!$user){
            return response()->json(['errors' => ['email' => ['Email not found.']]], 422); 
        }
        if($user->blocked){
            return response()->json(['errors' => ['blocked' => ['The user is blocked.']]], 422); 
        }

        $credentials = array_merge($request->only('email', 'password'), ['blocked' => 0]);
        if (Auth::attempt($credentials)) {
            return Auth::user();
        } else {
            return response()->json(['errors' => ['password' => ['Invalid Password.']]], 422); 
        }
    }
    public function logout()
    {
        Auth::guard('web')->logout(); //check if Auth::logout(); works
        return response()->json(['msg' => 'User session closed'], 200);
    }
}
