<?php

namespace App\Providers;

use App\Contracts\Repositories\AuthRepository;
use App\Contracts\Repositories\ContactRepository;
use App\Contracts\Repositories\FileRepository;
use App\Contracts\Services\AuthContract;
use App\Contracts\Services\ContactContract;
use App\Contracts\Services\FileContract;
use App\Repositories\AuthRepositoryEloquent;
use App\Repositories\ContactRepositoryEloquent;
use App\Repositories\FileRepositoryEloquent;
use App\Services\AuthService;
use App\Services\ContactService;
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

        $this->app->bind(ContactContract::class, ContactService::class);
        $this->app->bind(ContactRepository::class, ContactRepositoryEloquent::class);
    }
}
