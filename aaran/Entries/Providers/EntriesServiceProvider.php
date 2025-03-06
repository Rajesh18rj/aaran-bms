<?php

namespace Aaran\Entries\Providers;

use Aaran\Entries\Controllers\Sales\SalesInvoiceController;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

use Aaran\Entries\Livewire\Sales;
use Aaran\Entries\Livewire\Purchase;
use Aaran\Entries\Livewire\Payment;
use Aaran\Entries\Livewire\ExportSales;


class EntriesServiceProvider extends ServiceProvider
{
//    public function boot(): void
//    {
//        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//        $this->mergeConfigFrom(__DIR__ . '/../config.php','entries');
//
//        $this->app->register(EntriesRouteServiceProvider::class);
//
//        Livewire::component('sales.index', Sales\Index::class);
//
//    }

    protected string $moduleName = 'Entries';
    protected string $moduleNameLower = 'entries';

    public function register(): void
    {
        $this->app->register(EntriesRouteServiceProvider::class);

        $this->app->bind(SalesInvoiceController::class, function ($app) {
            return new SalesInvoiceController();
        });

        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();

        Livewire::component('sales.index', Sales\Index::class);
        Livewire::component('sales.upsert', Sales\Upsert::class);
        Livewire::component('sales.eway-bill', Sales\EwayBill::class);
        Livewire::component('sales.einvoice', Sales\Einvoice::class);

        Livewire::component('purchase.index', Purchase\Index::class);
        Livewire::component('purchase.upsert', Purchase\Upsert::class);

        Livewire::component('payment.index', Payment\Index::class);

        Livewire::component('export-sales.index', ExportSales\Index::class);
        Livewire::component('export-sales.upsert', ExportSales\Upsert::class);
        Livewire::component('export-sales.packing-list', ExportSales\PackingList::class);

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
