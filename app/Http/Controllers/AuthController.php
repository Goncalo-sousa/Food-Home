<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\Register;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

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
}
