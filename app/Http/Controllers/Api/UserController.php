<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->validated());
        $user->password = bcrypt($user->password);
        $user->save();
        return response()->json(new UserResource($user), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user);
    }

    public function update_avatar(Request $request, User $user)
    {
        $imageName = time() . '.' . $request->photo_url->getClientOriginalExtension();
        $request->photo_url->move(public_path('storage/fotos/'), $imageName);
        $user->photo_url = $imageName;
        $user->save();
        return response()->json(['success' => 'You have successfully upload image.']);
    }



    public function changePassword(Request $request)
    {
        $user = User::find($request->id);
        if (Hash::check($request->input('old_password'), $user->password) && ($request->input('new_password') == $request->input('repeat_password'))) {

            $user->update([
                'password' => Hash::make($request->input('new_password'))
            ]);

            return response()->json([
                'message' => 'Password updated'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->customer->delete();
        $user->customer->orders->order_items->delete();
        $user->customer->orders->delete();
        $user->delete();
        return response()->json(null, 204);
    }
    
}