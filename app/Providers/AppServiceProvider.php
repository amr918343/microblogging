<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\BusinessLogic\{
    Interfaces\IAuthService,
    Interfaces\IFollowService,
    Interfaces\ITweetService,
    AuthService,
    FollowService,
    TweetService
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IFollowService::class, FollowService::class);
        $this->app->bind(ITweetService::class, TweetService::class);
    }
}
