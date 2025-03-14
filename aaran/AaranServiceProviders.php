<?php

namespace Aaran;

use Aaran\Assets\Providers\AssetsServiceProvider;
use Aaran\Auth\AuthServiceProvider;
use Aaran\Blog\Providers\BlogServiceProvider;
use Aaran\Books\Providers\BooksServiceProvider;
use Aaran\Common\Providers\CommonServiceProvider;
use Aaran\Core\Providers\CoreServiceProvider;
use Aaran\Core\Providers\EventServiceProvider;
use Aaran\Core\Services\StartupService;
use Aaran\Docs\Providers\DocsServiceProvider;
use Aaran\Entries\Providers\EntriesServiceProvider;
use Aaran\Master\Providers\MasterServiceProvider;
use Aaran\MasterGst\Providers\MasterGstServiceProvider;
use Aaran\Reports\Providers\ReportsServiceProvider;
use Aaran\Setup\Providers\SetupServiceProvider;
use Aaran\Transaction\Providers\TransactionServiceProvider;
use Aaran\Web\Providers\WebServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AaranServiceProviders extends ServiceProvider
{

    public function boot()
    {
        $startupService = app(StartupService::class);

        $startupService->loadSettings();

//        if (!$startupService->checkSystemHealth()) {
//            exit('System requirements not met.');
//        }
//
//        if ($startupService->checkForUpdates()) {
//            Artisan::call('migrate --force');
//        }


        // Auto-register Livewire components in Aaran modules
        Livewire::component('user-table', Auth\Identity\Livewire\Class\UserTable::class);
        Livewire::component('user-form', Auth\Identity\Livewire\Class\UserForm::class);
        Livewire::component('user-profile', Auth\Identity\Livewire\Class\UserProfile::class);
    }

    public function register(): void
    {

      $this->app->register(SetupServiceProvider::class);

        $this->app->register(EventServiceProvider::class);

        $this->app->register(AssetsServiceProvider::class);

        $this->app->register(AuthServiceProvider::class);

        $this->app->register(WebServiceProvider::class);

        $this->app->register(CoreServiceProvider::class);

        $this->app->register(CommonServiceProvider::class);

        $this->app->register(BooksServiceProvider::class);

        $this->app->register(BlogServiceProvider::class);

        $this->app->register(DocsServiceProvider::class);

        $this->app->register(MasterServiceProvider::class);

        $this->app->register(EntriesServiceProvider::class);

        $this->app->register(MasterGstServiceProvider::class);

        $this->app->register(TransactionServiceProvider::class);

        $this->app->register(ReportsServiceProvider::class);

    }
}
