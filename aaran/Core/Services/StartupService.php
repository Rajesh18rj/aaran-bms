<?php

namespace Aaran\Core\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Aaran\Core\Models\Setting;

class StartupService
{
    public function loadSettings()
    {
        Log::info("Loading system settings...");

        return Cache::rememberForever('aaran.settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    public function checkSystemHealth()
    {
        try {
            DB::connection()->getPdo();
            Log::info("Database connection verified.");
            return true;
        } catch (\Exception $e) {
            Log::error("Database connection failed: " . $e->getMessage());
            return false;
        }
    }

    public function checkForUpdates()
    {
        $currentVersion = config('aaran.version');
        $installedVersion = DB::table('software_versions')->latest('id')->value('version');

        if (version_compare($installedVersion, $currentVersion, '<')) {
            Log::info("New software update available: $currentVersion");
            return true;
        }

        return false;
    }
}
