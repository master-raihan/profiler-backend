<?php

namespace App\Providers;

use App\Contracts\Repositories\AuthRepository;
use App\Contracts\Repositories\FileRepository;
use App\Contracts\Services\AuthContract;
use App\Contracts\Services\FileContract;
use App\Repositories\AuthRepositoryEloquent;
use App\Repositories\FileRepositoryEloquent;
use App\Services\AuthService;
use App\Services\FileService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FileContract::class, FileService::class);
        $this->app->bind(FileRepository::class, FileRepositoryEloquent::class);

        $this->app->bind(AuthContract::class, AuthService::class);
        $this->app->bind(AuthRepository::class, AuthRepositoryEloquent::class);
    }
}
