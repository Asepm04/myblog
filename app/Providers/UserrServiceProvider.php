<?php

namespace App\Providers;

// use App\Services\Userservices;
// use App\Services\Impl\Userserviceimpl;
use App\Servicess\Userserv;
use App\Servicess\Implement\Userservimpl;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;


class UserrServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // public array $singletons = [
    //     Userservices::class => Userserviceimpl::class
    // ];
    public array $singletons = [ Userserv::class => Userservimpl::class];

    public function provides(): array
    {
        // return [Userservices::class];
        return [Userserv::class];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(Userservices::class,function($app)
        // {
        //    return  Userserviceimpl::class
        // }
        // );
        $this->app->singleton(Userserv::class,Userservimpl::class);
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
