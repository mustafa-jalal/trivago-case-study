<?php

namespace App\Modules\User;

use App\Modules\User\Repositories\UserRepository;
use App\Modules\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerMigrations();
        $this->registerRoutes();
    }

    private function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../User/Database/Migrations');
    }

    private function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../User/Routes/v1.php');
    }
}
