<?php

namespace Hammadj\HelpIcons;

use Hammadj\HelpIcons\Services\HelpIconService;
use Illuminate\Support\ServiceProvider;

class HelpIconsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(HelpIconService::class, function ($app) {
            return new HelpIconService();
        });

        // Register console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Hammadj\HelpIcons\Console\Commands\MakeViewsCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'help-icons');

        // Publish assets (JS)
        $this->publishes([
            __DIR__ . '/../public/js' => public_path('vendor/help-icons/js'),
        ], 'public');
        
    }
}
