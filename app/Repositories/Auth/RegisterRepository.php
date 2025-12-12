<?php

namespace App\Repositories\Auth;

use App\Http\Resources\UserResource;
use App\Models\Permission;
use App\Models\Auth;
use App\Models\User;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterRepository implements RegisterRepositoryInterface
{
    public function register($request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'token' => $token,
            'user'  => new UserResource($user),
        ];
    }
}
