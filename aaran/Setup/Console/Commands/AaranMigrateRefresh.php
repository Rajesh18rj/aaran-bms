<?php

namespace Aaran\Setup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AaranMigrateRefresh extends Command
{
    protected $signature = 'aaran:migrate:refresh {--seed}';
    protected $description = 'Refresh migrations including core and industry-specific ones in a predefined order';

    public function handle()
    {
        $this->info('Rolling back migrations...');
        Artisan::call('migrate:reset', ['--force' => true]);

        $migrationOrder = config('aaran.migration_order', []);
        $coreMigrationPath = base_path('Aaran/Core/Database/Migrations');
        $industries = config('aaran.industries', []);

        // Execute Core Migrations in Order
        if (File::isDirectory($coreMigrationPath)) {
            foreach ($migrationOrder as $migration) {
                $this->runMigration($coreMigrationPath, $migration);
            }
        }

        // Execute Industry-Specific Migrations in Order
        foreach ($industries as $industry) {
            $industryMigrationPath = base_path("Aaran/Industries/{$industry}/Database/Migrations");
            if (File::isDirectory($industryMigrationPath)) {
                foreach ($migrationOrder as $migration) {
                    $this->runMigration($industryMigrationPath, $migration);
                }
            }
        }

        $this->info('Migrations refreshed successfully!');

        if ($this->option('seed')) {
            $this->info('Running database seeders...');
            Artisan::call('db:seed', ['--force' => true]);
        }
    }

    /**
     * Execute migration file in order
     */
    private function runMigration($path, $migration)
    {
        $file = collect(File::files($path))->first(fn($f) => str_contains($f->getFilename(), $migration));

        if ($file) {
            Artisan::call('migrate', ['--path' => str_replace(base_path(), '', $file->getPath()), '--force' => true]);
            Log::info("Migration executed: {$file->getFilename()}");
            $this->info("Migration executed: {$file->getFilename()}");
        } else {
            Log::warning("Migration file not found: {$migration}");
            $this->warn("Migration file not found: {$migration}");
        }
    }
}
