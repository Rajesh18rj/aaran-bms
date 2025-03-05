<?php

namespace Aaran\Setup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeLivewireComponentCommand extends Command
{
    protected $signature = 'aaran:livewire {root} {path}';
    protected $description = 'Create a new Aaran Livewire Component';

    public function handle()
    {
        $rootModule = ucfirst($this->argument('root')); // Convert "web.sundar" to "Web.Sundar"
        $fullPath = $this->argument('path');

        // Convert dot notation into folder structure
        $rootPath = str_replace('.', '/', $rootModule); // "Web.Sundar" => "Web/Sundar"
        $rootNamespace = str_replace('.', '\\', $rootModule); // "Web.Sundar" => "Web\Sundar"

        // Extract component name and module path
        $segments = explode('.', $fullPath);
        $className = ucfirst(array_pop($segments)); // Last segment is the component name
        $modulePath = implode('/', $segments); // Convert remaining segments into a path
        $namespace = implode('\\', $segments); // Convert remaining segments into a namespace

        if (empty($namespace)) {
            $this->error("❌ Invalid component path. Use: php artisan aaran:livewire Web.Home.Index");
            return;
        }

        // Ensure Livewire is always inside the root module
        $livewirePath = base_path("Aaran/{$rootPath}/Livewire/{$modulePath}");
        $classPath = "{$livewirePath}/{$className}.php";
        $viewPath = "{$livewirePath}/" . strtolower($className) . ".blade.php";

        $filesystem = new Filesystem;

        // Ensure Livewire Folder Exists
        if (!$filesystem->isDirectory($livewirePath)) {
            $filesystem->makeDirectory($livewirePath, 0755, true, true);
        }

        // Create Livewire Class File
        if (!$filesystem->exists($classPath)) {
            $filesystem->put($classPath, $this->generateClassContent($rootNamespace, $namespace, $className));
            $this->info("✅ Livewire component class created: {$classPath}");
        } else {
            $this->warn("⚠️ Livewire component class already exists: {$classPath}");
        }

        // Create Livewire View File
        if (!$filesystem->exists($viewPath)) {
            $filesystem->put($viewPath, $this->generateViewContent());
            $this->info("✅ Livewire view created: {$viewPath}");
        } else {
            $this->warn("⚠️ Livewire view already exists: {$viewPath}");
        }
    }

    protected function generateClassContent($rootNamespace, $namespace, $className)
    {
        return <<<PHP
        <?php

        namespace Aaran\\{$rootNamespace}\\Livewire\\{$namespace};

        use Livewire\Component;

        class {$className} extends Component
        {
            public function render()
            {
                return view('Aaran.{$rootNamespace}.Livewire.{$namespace}.{$className}');
            }
        }
        PHP;
    }

    protected function generateViewContent()
    {
        return <<<BLADE
        <div>
            <!-- Livewire Component -->
        </div>
        BLADE;
    }
}
