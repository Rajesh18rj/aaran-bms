<?php

namespace Aaran\Setup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupAaranCommand extends Command
{
    protected $signature = 'aaran:setup {name} {--b|base} {--a|all} {--f|force} {--u|update}';
    protected $description = 'Set up an Aaran module with required files and structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $isBase = $this->option('base');
        $isAll = $this->option('all');
        $force = $this->option('force');
        $update = $this->option('update');

        // Default to base if no specific option is provided
        if (!$isBase && !$isAll) {
            $isBase = true;
        }

        $this->createModule($name, $isBase, $isAll, $force, $update);
    }

    /**
     * Create the module directory structure and necessary files.
     *
     * @param string $name The module name.
     * @param bool $isBase Whether to create only base files.
     * @param bool $isAll Whether to create all files.
     * @param bool $force Whether to overwrite existing files.
     * @param bool $update Whether to create only missing files.
     */
    private function createModule(string $name, bool $isBase, bool $isAll, bool $force, bool $update)
    {
        $basePath = base_path("Aaran/$name");

        $folders = ['Models', 'Routes', 'Services', 'Providers', 'Laravel/Class', 'Laravel/Views', 'Database/Migrations', 'Database/Seeders', 'Database/Factories'];

        if ($isAll) {
            $folders = array_merge($folders, [
                'Http/Controllers', 'Tests/Feature', 'Config'
            ]);
        }

        // Create directories
        foreach ($folders as $folder) {
            File::ensureDirectoryExists("$basePath/$folder");
        }


        // List of files to create
        $files = [
            "$basePath/Providers/{$name}ServiceProvider.php" => 'service-provider',
        ];

        if ($isAll) {
            $files = array_merge($files, [
                "$basePath/Routes/api.php" => 'api-routes',
                "$basePath/Routes/web.php" => 'web-routes',
                "$basePath/Config/config.php" => 'config',
            ]);
        }

        // Process files based on --force or --update
        foreach ($files as $path => $stub) {
            if ($force || ($update && !File::exists($path)) || !File::exists($path)) {
                $this->createFile($path, $this->getStubContent($stub, $name), $force);
            }
        }

        $this->info(" ✅  Aaran module [$name] created successfully!");
    }

    /**
     * Create a file with given content.
     *
     * @param string $path File path.
     * @param string $content File content.
     * @param bool $force Whether to overwrite the file.
     */
    private function createFile(string $path, string $content, bool $force)
    {
        if (File::exists($path) && !$force) {
            $this->info("Skipped (exists): $path");
            return;
        }

        File::put($path, $content);
        $this->info("Created: $path");
    }

    /**
     * Get stub content from a file and replace placeholders.
     *
     * @param string $type The stub type.
     * @param string $name The module name.
     *
     * @return string Stub content.
     */
    private function getStubContent(string $type, string $name): string
    {
        $stubPath = base_path("Aaran/Setup/Stubs/{$type}.stub");

        if (!File::exists($stubPath)) {
            return '';
        }

        return str_replace('{{name}}', $name, File::get($stubPath));
    }
}
