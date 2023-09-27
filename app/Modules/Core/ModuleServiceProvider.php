<?php

namespace App\Modules\Core;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerMigrations();
    }

    private function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Core/Database/Migrations');
    }
}
