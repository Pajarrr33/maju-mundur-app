<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Users;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        if(Users::where('email', $data['email'])->count() == 1) {
            // email already exists
            throw new HttpResponseException(response()->json([
                'message' => 'Email already exists'
            ], 400));
        }
        
        $user = new Users($data);
        $user->password = Hash::make($data['password']);
        $user->save();


        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function login(UserLoginRequest $request): UserResource
    {
        $data = $request->validated();

        $user = Users::where('email', $data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response()->json([
                'message' => 'Email or password wrong'
            ], 401));
        }

        $user->token = Str::uuid()->toString();
        $user->save();

        return new UserResource($user);
    }
}
