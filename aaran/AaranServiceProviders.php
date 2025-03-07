<?php

namespace Aaran;

use Aaran\Assets\Providers\AssetsServiceProvider;
use Aaran\Blog\Providers\BlogServiceProvider;
use Aaran\Books\Providers\BooksServiceProvider;
use Aaran\Common\Providers\CommonServiceProvider;
use Aaran\Core\Providers\CoreServiceProvider;
use Aaran\Core\Providers\EventServiceProvider;
use Aaran\Docs\Providers\DocsServiceProvider;
use Aaran\Entries\Providers\EntriesServiceProvider;
use Aaran\Master\Providers\MasterServiceProvider;
use Aaran\MasterGst\Providers\MasterGstServiceProvider;
use Aaran\Reports\Providers\ReportsServiceProvider;
use Aaran\Transaction\Providers\TransactionServiceProvider;
use Aaran\Web\Providers\WebServiceProvider;
use Illuminate\Support\ServiceProvider;

class AaranServiceProviders extends ServiceProvider
{
    public function register(): void
    {

        $this->app->register(EventServiceProvider::class);

        $this->app->register(AssetsServiceProvider::class);

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
