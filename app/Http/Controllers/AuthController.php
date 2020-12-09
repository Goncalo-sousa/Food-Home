<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\Register;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;

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
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Auth::user();
        } else {
            return response()->json(
                ['message' => 'Unauthenticated .'],
                401
            );
        }
    }
    public function logout()
    {
        Auth::guard('web')->logout(); //check if Auth::logout(); works
        return response()->json(['msg' => 'User session closed'], 200);
    }
}
