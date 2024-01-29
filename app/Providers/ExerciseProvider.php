<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Exercise\Exservice;
use App\Exercise\Eximpl\Exserviceimpl;


class ExerciseProvider extends ServiceProvider
{

        public function provides():array
        {
            return [Exservice::class];
        }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Exservice::class,Exserviceimpl::class);
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
