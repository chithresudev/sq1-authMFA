<?php
 
namespace Sq1\AuthMfa\Providers;
 
use Illuminate\Support\ServiceProvider;
 
class AuthMFAServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/auth.php');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->publishes([
            __DIR__.'/../views/' => resource_path('views/'),
        ]);

        $this->publishes([
            __DIR__.'/../Controllers/AuthMFA' => app_path('HTTP/Controllers/'),
        ]);

        $this->publishes([
            __DIR__.'/../MFAServices' => app_path('MFAServices'),
        ]);



    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/authmfa.php', 'authmfa'
        );
    }

}