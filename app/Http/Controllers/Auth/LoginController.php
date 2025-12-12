<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Auth\LoginRepositoryInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $repo;

    function __construct(LoginRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    
    public function login(LoginRequest $request)
    {
        
       $data = $this->repo->login($request);

       return response()->json([
            'status' => 'success',
            'message' => 'Registration successful.',
            'data' => $data
        ], 201);
    }
}
