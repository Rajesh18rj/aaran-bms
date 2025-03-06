<?php

namespace Aaran\Assets\Core;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeAaranModule extends Command
{
    protected $signature = 'aaran:make {module} {--m|model} {--f|factory} {--s|seeder} {--a|all}';
    protected $description = 'Create a new Aaran module with optional Model, Factory, and Seeder';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $module = $this->argument('module');
        $createModel = $this->option('model');
        $createFactory = $this->option('factory');
        $createSeeder = $this->option('seeder');
        $createAll = $this->option('all');

        $modulePath = base_path("aaran/{$module}");

        if (File::exists($modulePath)) {
            $this->error("Module {$module} already exists.");
            return;
        }

        File::makeDirectory($modulePath, 0755, true);

        if ($createModel) {
            $this->createModel($module);
        }

        if ($createFactory) {
            $this->createFactory($module);
        }

        if ($createSeeder) {
            $this->createSeeder($module);
        }

        if ($createAll) {
            $this->createModel($module);
            $this->createFactory($module);
            $this->createSeeder($module);
        }


        $this->info("Module {$module} created successfully.");
    }

    protected function createModel($module): void
    {
        $modelPath = base_path("aaran/{$module}/Models/{$module}.php");
        File::ensureDirectoryExists(dirname($modelPath));
        File::put($modelPath, "<?php\n\nnamespace Aaran\\{$module}\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass {$module} extends Model\n{\n    //\n}\n");
        $this->info("Model created successfully.");
    }

    protected function createFactory($module): void
    {
        $factoryPath = base_path("aaran/{$module}/Database/factories/{$module}Factory.php");
        File::ensureDirectoryExists(dirname($factoryPath));
        File::put($factoryPath, "<?php\n\nnamespace Aaran\\{$module}\\Database\\Factories;\n\nuse Illuminate\\Database\\Eloquent\\Factories\\Factory;\n\nclass {$module}Factory extends Factory\n{\n    protected \$model = \\Aaran\\{$module}\\Models\\{$module}::class;\n\n    public function definition()\n    {\n        return [\n            //\n        ];\n    }\n}\n");
        $this->info("Factory created successfully.");
    }

    protected function createSeeder($module): void
    {
        $seederPath = base_path("aaran/{$module}/Database/seeders/{$module}Seeder.php");
        File::ensureDirectoryExists(dirname($seederPath));
        File::put($seederPath, "<?php\n\nnamespace Aaran\\{$module}\\Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\n\nclass {$module}Seeder extends Seeder\n{\n    public function run()\n    {\n        //\n    }\n}\n");
        $this->info("Seeder created successfully.");
    }
}
