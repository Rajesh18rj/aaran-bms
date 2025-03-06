<?php

namespace Aaran\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

use Aaran\Common\Livewire\city; // Example
use Aaran\Common\Livewire\state;
use Aaran\Common\Livewire\pincode;
use Aaran\Common\Livewire\country;
use Aaran\Common\Livewire\hsncode;
use Aaran\Common\Livewire\unit;
use Aaran\Common\Livewire\category;
use Aaran\Common\Livewire\colour;
use Aaran\Common\Livewire\size;
use Aaran\Common\Livewire\department;
use Aaran\Common\Livewire\transport;
use Aaran\Common\Livewire\bank;
use Aaran\Common\Livewire\gst;
use Aaran\Common\Livewire\receipttype;
use Aaran\Common\Livewire\dispatch;
use Aaran\Common\Livewire\PaymentMode;
use Aaran\Common\Livewire\ContactType;
use Aaran\Common\Livewire\AccountType;
use Aaran\Common\Livewire\TransactionType;


class CommonServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Common';
    protected string $moduleNameLower = 'common';

    public function register(): void
    {
        $this->app->register(CommonRouteServiceProvider::class);
        $this->loadConfigs();
        $this->loadViews();
    }

    public function boot(): void
    {
        $this->loadMigrations();
//        $this->mapApiRoutes();
//        $this->mapWebRoutes();

        // Register Livewire components
        Livewire::component('common::city-list', city\CityList::class);
        Livewire::component('common::state-list', state\StateList::class);
        Livewire::component('common::pincode-list', pincode\PincodeList::class);
        Livewire::component('common::country-list', country\CountryList::class);
        Livewire::component('common::hsncode-list', hsncode\HsncodeList::class);
        Livewire::component('common::unit-list', unit\UnitList::class);
        Livewire::component('common::category-list', category\CategoryList::class);
        Livewire::component('common::colour-list', colour\ColourList::class);
        Livewire::component('common::size-list', size\SizeList::class);
        Livewire::component('common::department-list', department\DepartmentList::class);
        Livewire::component('common::transport-list', transport\TransportList::class);
        Livewire::component('common::bank-list', bank\BankList::class);
        Livewire::component('common::gst-list', gst\GstList::class);
        Livewire::component('common::receipt-type-list', receipttype\ReceiptTypeList::class);
        Livewire::component('common::dispatch-list', dispatch\DispatchList::class);
        Livewire::component('common::contact-type-list', ContactType\ContactTypeList::class);
        Livewire::component('common::payment-mode-list', PaymentMode\PaymentModeList::class);
        Livewire::component('common::account-type-list', AccountType\AccountTypeList::class);
        Livewire::component('common::transaction-type-list', TransactionType\TransactionTypeList::class);

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
//
//    protected function mapWebRoutes()
//    {
//        Route::middleware('web')
//            ->prefix($this->moduleNameLower)
//            ->namespace("Modules\\{$this->moduleName}\\Http\\Controllers")
//            ->group(__DIR__ . '/../Routes/web.php');
//    }
//
//    protected function mapApiRoutes()
//    {
//        Route::prefix('api')
//            ->middleware('api')
//            ->namespace("Modules\\{$this->moduleName}\\Http\\Controllers")
//            ->group(__DIR__ . '/../Routes/api.php'); // Optional API routes
//    }

}
