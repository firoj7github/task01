<?php

namespace App\Providers;

use App\Repositories\Auth\LoginRepository;
use App\Repositories\Auth\LoginRepositoryInterface;
use App\Repositories\Auth\RegisterRepository;
use App\Repositories\Auth\RegisterRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    public function boot()
    {
        //
    }
}
