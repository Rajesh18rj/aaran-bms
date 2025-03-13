<?php

namespace Aaran\Reports\Providers;

use Aaran\Reports\Livewire\Contact\ContactReport;
use Aaran\Reports\Livewire\Contact\PartyReport;
use Aaran\Reports\Livewire\Sales\GstReport;
use Aaran\Reports\Livewire\Sales\MonthlyReport;
use Aaran\Reports\Livewire\Statement\Payable;
use Aaran\Reports\Livewire\Statement\PayablesReport;
use Aaran\Reports\Livewire\Statement\Receivable;
use Aaran\Reports\Livewire\Statement\ReceivablesReport;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ReportsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Reports';
    protected string $moduleNameLower = 'reports';

    public function register(): void
    {
        $this->app->register(ReportsRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('reports::contact-report', ContactReport::class);
        Livewire::component('reports::party-report', PartyReport::class);

        Livewire::component('reports::receivable', Receivable::class);
        Livewire::component('reports::payable', Payable::class);
        Livewire::component('reports::payables-report', PayablesReport::class);
        Livewire::component('reports::receivables-report', ReceivablesReport::class);

        Livewire::component('reports::gst-report', GstReport::class);
        Livewire::component('reports::monthly-report', MonthlyReport::class);


    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', $this->moduleNameLower);
    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Livewire', $this->moduleNameLower);
    }

    protected function loadMigrations(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
