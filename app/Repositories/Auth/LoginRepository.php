<?php

namespace App\Repositories\Auth;

use App\Http\Resources\UserResource;
use App\Models\Permission;
use App\Models\Auth;
use App\Models\User;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginRepository implements LoginRepositoryInterface
{
    public function login($request)
    {


        $user = User::where('email', $request->email)
            ->first();

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'The credentials do not match.'
            ], 400);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'The credentials do not match.'
            ], 400);
        }

        // Sanctum Token Create
        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'token' => $token,
            'user'  => new UserResource($user),
        ];

    }
}
