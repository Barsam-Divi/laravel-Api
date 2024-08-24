<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        return response([
            'data' => [
                'users' => UserResource::collection(User::all())
            ]
        ]);
    }

    public function show(User $user)
    {
        return response()->json([
            'data' => [
                'user' => new UserResource($user)
            ]
        ]);
    }

    public function register(RegisterRequest $request)
    {

        $role = Role::query()->where('title', 'normal_user')->first();

        $user = User::query()->create([
            'role_id' => $role->id,
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);



        return response()->json([
            'data' => [
                'user' => new UserResource($user)
            ]
        ])->setStatusCode(201);
    }



    public function login(LoginRequest $request)
    {



        $user = User::query()->where('email' , $request->get('email'))->first();

        $permission = $user->role->permissions()->pluck('title')->toArray();


        if (!Hash::check($request->get('password'),$user->password))
        {
            return response()->json([
                'data' => [
                    'message' => 'wrong password'
                ]
            ])->setStatusCode(400);
        }



        $user->tokens()->delete();


        return response()->json([
            'data' => [
                'token' => $user->createToken('token',$permission)->plainTextToken
            ]
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'data' => [
                'message' => 'you are log out now'
            ]
        ]);
    }
}
