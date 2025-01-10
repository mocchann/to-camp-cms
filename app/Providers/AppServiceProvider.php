<?php

namespace App\Providers;

use App\Domain\Models\CampGrounds\ICampGroundRepository;
use App\Domain\Models\Users\IUserRepository;
use App\EF\CampGrounds\CampGroundRepository;
use App\EF\Users\UserRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
