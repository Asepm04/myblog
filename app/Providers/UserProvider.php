<?php

namespace App\Providers;

use App\Services\UserService;
use App\Services\Impl\UserServiceimpl;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class UserProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [UserService::class => UserServiceimpl::class];

    public function provides(): array
    {
        return [UserService::class];
    }
      /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(UserService::class , UserServiceimpl::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
