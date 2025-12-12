<?php

namespace App\Providers;

use App\Repositories\Auth\LoginRepository;
use App\Repositories\Auth\LoginRepositoryInterface;
use App\Repositories\Auth\RegisterRepository;
use App\Repositories\Auth\RegisterRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
    }

    public function boot()
    {
        //
    }
}
