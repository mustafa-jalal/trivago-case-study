<?php

namespace App\Modules\Accommodation;

use App\Modules\Accommodation\Models\Accommodation;
use App\Modules\Accommodation\Policies\AccommodationPolicy;
use App\Modules\Accommodation\Repositories\AccommodationRepository;
use App\Modules\Accommodation\Repositories\AccommodationRepositoryInterface;;

use App\Modules\Accommodation\Repositories\LocationRepository;
use App\Modules\Accommodation\Repositories\LocationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected array $policies = [
        Accommodation::class => AccommodationPolicy::class,
    ];

    /**
     * Register any application services.
     */
    final public function register(): void
    {
        $this->app->bind(AccommodationRepositoryInterface::class, AccommodationRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    final public function boot(): void
    {
        $this->registerMigrations();
        $this->registerRoutes();
    }

    private function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Accommodation/Database/Migrations');
    }

    private function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Accommodation/Routes/v1.php');
    }
}
