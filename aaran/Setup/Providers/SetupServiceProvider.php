<?php

namespace Aaran\Setup\Providers;


use Aaran\Setup\Console\Commands\AaranSetupCommand;
use Aaran\Setup\Console\Commands\MakeLivewireComponentCommand;
use Aaran\Setup\Console\Commands\MakeModuleCommand;
use Illuminate\Support\ServiceProvider;

class SetupServiceProvider extends  ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            AaranSetupCommand::class,// Registering the setup command
            MakeModuleCommand::class,// Registering the new module command
            MakeLivewireComponentCommand::class, // Registering the command for make livewire class-view
        ]);
    }

}
