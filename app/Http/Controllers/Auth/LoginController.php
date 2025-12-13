<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Auth\LoginRepositoryInterface;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $repo;

    function __construct(LoginRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    use ApiReturnFormatTrait;
    
    public function login(LoginRequest $request)
    {
        
       $data = $this->repo->login($request);

       return $this->responseWithSuccess('Login successful', $data, 201);

    }
}
