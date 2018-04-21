<?php

namespace Turkalp\Language;

use Illuminate\Support\ServiceProvider;
use Turkalp\Language\Commands\MakeMigrationManyToManyTable;

require_once __DIR__.'/commands/MakeMigrationManyToManyTable.php';

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->commands([
            MakeMigrationManyToManyTable::class
        ]);

        $this->publishes([
            __DIR__.'/database/seeds/LanguageSeeder.stub' => database_path('seeds/LanguageSeeder.php')
        ], 'seeds');

        $this->commands([
            MakeMigrationManyToManyTable::class
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}
