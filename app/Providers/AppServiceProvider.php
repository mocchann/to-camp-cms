<?php

namespace App\Providers;

use App\Domain\Models\CampGrounds\ICampGroundFileRepository;
use App\Domain\Models\CampGrounds\ICampGroundRepository;
use App\Domain\Models\Users\IUserRepository;
use App\Repositories\CampGrounds\CampGroundFileRepository;
use App\Repositories\CampGrounds\CampGroundRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICampGroundRepository::class, CampGroundRepository::class);
        $this->app->bind(ICampGroundFileRepository::class, CampGroundFileRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
