<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\TodolistService;
use App\Services\Impl\TodolistServiceImpl;

class TodolistProvider extends ServiceProvider implements DeferrableProvider
{

    public function provides()
    {
        return [TodolistService::class];
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TodolistService::class,TodolistServiceImpl::class);
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
