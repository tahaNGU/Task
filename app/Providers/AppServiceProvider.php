<?php

namespace App\Providers;

use App\Repositories\Task\TaskEloquentRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserEloquentRepository::class);
        $this->app->bind(TaskRepositoryInterface::class,TaskEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
