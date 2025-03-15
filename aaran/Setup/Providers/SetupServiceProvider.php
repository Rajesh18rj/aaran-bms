<?php

namespace Aaran\Setup\Providers;

use Aaran\Setup\Console\Commands\SetupAaranCommand;
use Illuminate\Support\ServiceProvider;
use Aaran\Setup\Console\Commands\AaranMigrateRefresh;

class SetupServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            SetupAaranCommand::class,
        ]);

        $this->commands([
            AaranMigrateRefresh::class,
        ]);

    }
}
