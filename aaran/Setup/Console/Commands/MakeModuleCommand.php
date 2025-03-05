<?php

namespace Aaran\Setup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Helper\ProgressBar;

class MakeModuleCommand extends Command
{
    protected $signature = 'aaran:make {model} {--M=} {--T=} {--force}';
    protected $description = 'Create a new Aaran module';

    public function handle()
    {
        $modelName = ucfirst($this->argument('model'));
        $module = $this->option('M');
        $type = $this->option('T');
        $modulePath = base_path("aaran/{$module}");
        $modelPath = base_path("aaran/{$module}/{$modelName}");


        // Ensure Module Folder Exists
        if (!$module) {
            $this->error("❌ No Module specified. Use --M=ModuleName");
            return;
        }

        // Ensure Module Folder Exists
        if (!File::exists($modulePath)) {
            $confirm = $this->choice(
                "🚀 The module '$module' does not exist. Do you want to create it?",
                ['Yes', 'No'],
                0 // Default to "Yes"
            );

            if ($confirm === 'Yes') {
                File::makeDirectory($modulePath, 0755, true, true);
                $this->info("📁 Created module directory: $modulePath");
            } else {
                $this->error("❌ Module creation aborted.");
                return;
            }
        }

        $this->info("🚀 Creating module: {$modelName}");


        // Get module structure based on type
        $directories = $this->getModuleStructure();


        // Create directories
        foreach ($directories as $dir) {
            File::makeDirectory("{$modelPath}/{$dir}", 0755, true, true);
        }

        // Copy stub files
        $this->generateStubFiles($modelPath, $modelName);

        // Register module in config
        //  $this->registerModule($moduleName);

        $this->info("✅ Module '{$modelName}' created successfully!");
    }

    protected function getModuleStructure(): array
    {
        $type = $this->option('T');

        $baseStructure = ['Controllers', 'Models', 'Routes', 'Providers', 'Config', 'Migrations', 'Services', 'Test', 'Interfaces'];

        $structures = [
            'api' => array_merge($baseStructure, ['Middleware', 'Repositories', 'Test']),
            'ui' => array_merge($baseStructure, ['Components', 'Views', 'Assets']),
            'all' => array_merge($baseStructure, ['Middleware', 'Repositories', 'Events', 'Listeners', 'Test', 'Interfaces']),
        ];

        return $structures[$type] ?? $baseStructure;
    }

    protected function generateStubFiles($modelPath, $modelName)
    {
        $stubPath = base_path('Aaran/Setup/Stubs');

        // Base stubs
        $stubs = [
            'route-web.stub' => "Routes/web.php",
            'route-api.stub' => "Routes/api.php",
            'provider.stub' => "Providers/{$modelName}ServiceProvider.php",
            'model.stub' => "Models/{$modelName}.php",
            'migration.stub' => "Migrations/{$modelName}_migration.php",
            'test.stub' => "Test/{$modelName}Test.php",
            'service.stub' => "Services/{$modelName}Service.php",
            'config.stub' => "Config/{$modelName}.php",
            'service-interface.stub' => "Interfaces/{$modelName}ServiceInterface.php",
            'repository-interface.stub' => "Interfaces/{$modelName}RepositoryInterface.php"
        ];

//        // Additional stubs if --all is passed
//        if ($this->option('all')) {
//            $stubs += [
//                'middleware.stub' => "Middleware/{$modelName}Middleware.php",
//                'repository.stub' => "Repositories/{$modelName}Repository.php",
//                'event.stub' => "Events/{$modelName}Event.php",
//                'listener.stub' => "Listeners/{$modelName}Listener.php",
//                'test.stub' => "Test/{$modelName}Test.php",
//            ];
//        }

        $progressBar = new ProgressBar($this->output, count($stubs));
        $progressBar->start();

        // Generate files from stubs
        foreach ($stubs as $stub => $destination) {
            $stubFile = "{$stubPath}/{$stub}";

            if (!File::exists($stubFile)) {
                $this->warn("⚠️ Warning: Stub file '{$stub}' is missing, skipping...");
                continue;
            }

            $content = str_replace('{{ moduleName }}', $modelName, File::get($stubFile));


            File::put("{$modelPath}/{$destination}", $content);
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
        $this->info("✅ Stub files created successfully.");
    }

}
