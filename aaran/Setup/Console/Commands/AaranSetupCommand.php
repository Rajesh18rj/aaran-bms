<?php

namespace Aaran\Setup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AaranSetupCommand extends Command
{
    protected $signature = 'aaran:setup';
    protected $description = 'Setup Aaran-BMS modular architecture';

    public function handle()
    {
        $this->info('Setting up Aaran-BMS modules...');

        // Define module paths
        $modules = ['Core', 'User', 'LMS', 'BMS', 'Accounts', 'ActivityLog'];

        foreach ($modules as $module) {
            $modulePath = base_path("Aaran/{$module}");
            // Create module structure
            File::makeDirectory($modulePath, 0755, true, true);
        }

        $this->info('Modules setup complete.');
    }
}
