<?php

namespace Aaran\Assets\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources', 'aaran-ui'); // Important: Load views from module

        $this->getComponent();
        $this->getConfig();
    }

    public function getComponent(): void
    {
        Blade::component('components.alert', 'alert'); // Name in view, class name (optional)

        Blade::component('components.menu.web.top-menu', 'web.top-menu');

        Blade::component('components.logo.aaran', 'aaran-logo');
        Blade::component('components.logo.cxlogo', 'cxlogo');

    }

    public function getConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'aaran-app');
        $this->mergeConfigFrom(__DIR__ . '/../software.php', 'software');
        $this->mergeConfigFrom(__DIR__ . '/../clients.php', 'clients');

        $this->mergeConfigFrom(__DIR__ . '/../Settings/developer.php', 'developer');
        $this->mergeConfigFrom(__DIR__ . '/../Settings/garment.php', 'garment');
        $this->mergeConfigFrom(__DIR__ . '/../Settings/offset.php', 'offset');
    }

    protected function loadMigrations(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
