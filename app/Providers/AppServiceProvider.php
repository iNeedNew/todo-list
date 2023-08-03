<?php

namespace App\Providers;

use App\Http\Resources\Api\Task\TaskResource;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskService::class, function ($app) {
            return new TaskService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TaskResource::withoutWrapping();
    }
}
