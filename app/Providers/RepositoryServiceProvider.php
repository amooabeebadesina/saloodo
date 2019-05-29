<?php


namespace App\Providers;


use App\Repositories\concrete\OrderRepository;
use App\Repositories\concrete\ProductRepository;
use App\Repositories\concrete\UserRepository;
use App\Repositories\contracts\OrderRepositoryInterface;
use App\Repositories\contracts\ProductRepositoryInterface;
use App\Repositories\contracts\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any Repositories.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }
}