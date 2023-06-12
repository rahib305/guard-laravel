<?php

use Illuminate\Support\ServiceProvider;

class GuardLaravelServiceProvider extends ServiceProvider {
    public function boot()
{
    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    $this->publishes([
        __DIR__.'/../database/migrations' => database_path('migrations'),
    ], 'migrations');
    $this->loadModels();
}

protected function loadModels()
{
    $models = [
        \Models\MainMenu::class,
        // Add more models as needed
    ];

    foreach ($models as $model) {
        if (!class_exists($model)) {
            continue;
        }

        $model::observe(ActivityLogObserver::class);
    }
}

}