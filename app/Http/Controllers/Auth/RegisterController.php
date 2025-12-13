<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Auth\RegisterRepositoryInterface;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  private $repo;

  function __construct(RegisterRepositoryInterface $repo)
  {
    $this->repo = $repo;
  }

  use ApiReturnFormatTrait;

  public function register(RegisterRequest $request)
  {
    $data = $this->repo->register($request);

    return $this->responseWithSuccess('Registration successful', $data, 201);
  }
}
