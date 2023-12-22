<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Repository\contracts\CategoryRepositoryContract;
use App\Repository\contracts\ProductRepositoryContract;
use App\Repository\contracts\UserRepositoryContract;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class , UserRepository::class); 
        $this->app->bind(CategoryRepositoryContract::class , CategoryRepository::class); 
        $this->app->bind(ProductRepositoryContract::class , ProductRepository::class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
