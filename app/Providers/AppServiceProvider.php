<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Sinjection;
use App\Services\Person;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Sinjection::class,function()
    {
        return new Sinjection();
    });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive("hello",function($expression)
    {
        return "<?php echo 'hello ' . $expression ?>";
    });

        Blade::stringable(Person::class,function(Person $person)
    {
        return "$person->name : $person->addres";
    });

    DB::listen(function(QueryExecuted $sql)
    {
       Log::info($sql->sql); 
    });
  }
}
