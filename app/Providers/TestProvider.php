<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Testt\TestService;
use App\Testt\Testimpl\TestServiceimpl;
class TestProvider extends ServiceProvider
{
    // public array $singletons = [TestService::class => TestServiceimpl::class];

    public function provides(): array
    {
        return [TestService::class];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TestService::class,TestServiceimpl::class);
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
