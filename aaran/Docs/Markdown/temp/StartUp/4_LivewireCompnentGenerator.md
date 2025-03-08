# Aaran Livewire Component Generator

## Introduction
The `aaran:livewire` command is a custom Laravel Artisan command designed for Aaran-BMS. It allows developers to quickly generate Livewire components within a structured modular architecture. This command ensures consistency by automatically creating the required class and view files inside the appropriate module folders.

## Command Syntax
```sh
php artisan aaran:livewire {module} {path}
```
- `{module}`: The root module where the Livewire component should be placed.
- `{path}`: The Livewire component structure inside the module.

## How It Works
1. **Creates a Livewire component class** inside the `Livewire/` directory of the specified module.
2. **Generates a corresponding Blade view** inside the same `Livewire/` directory.
3. **Ensures the correct namespace and folder structure** based on the given module and path.

## Example Usage
### 1. Basic Example (Single Module)
#### Command:
```sh
php artisan aaran:livewire Web Home.Index
```
#### Output:
✅ **Livewire component class created:**
📂 `Aaran/Web/Livewire/Home/Index.php`

✅ **Livewire view created:**
📂 `Aaran/Web/Livewire/Home/index.blade.php`

### 2. Nested Module Structure
#### Command:
```sh
php artisan aaran:livewire Web.Sundar Home.Index
```
#### Output:
✅ **Livewire component class created:**
📂 `Aaran/Web/Sundar/Livewire/Home/Index.php`

✅ **Livewire view created:**
📂 `Aaran/Web/Sundar/Livewire/Home/index.blade.php`

### 3. Using Multiple Modules
#### Command:
```sh
php artisan aaran:livewire BMS.Web Home.Index
```
#### Output:
✅ **Livewire component class created:**
📂 `Aaran/BMS/Web/Livewire/Home/Index.php`

✅ **Livewire view created:**
📂 `Aaran/BMS/Web/Livewire/Home/index.blade.php`

## Folder & Namespace Structure
The command ensures that:
- The **Livewire** folder is always placed inside the root module.
- The **namespace** follows Laravel’s conventions.
- The **view file** is named using lowercase.

### Example for `php artisan aaran:livewire Web.Sundar Home.Index`
```
Aaran/
  ├── Web/
  │    ├── Sundar/
  │    │    ├── Livewire/
  │    │    │    ├── Home/
  │    │    │    │    ├── Index.php
  │    │    │    │    ├── index.blade.php
```

### **Class Namespace:**
```php
namespace Aaran\Web\Sundar\Livewire\Home;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('Aaran.Web.Sundar.Livewire.Home.index');
    }
}
```

## Key Features
✅ **Automatic Namespace Management** – Converts module names into correct PHP namespaces.
✅ **Ensures Folder Structure Consistency** – Places Livewire files inside appropriate directories.
✅ **Supports Nested Modules** – Allows deep folder structures like `BMS.Web.Home.Index`.
✅ **Blade View Auto-Generation** – Creates a corresponding view file for the component.

## Common Errors & Fixes
### 1. Error: `Not enough arguments (missing: "path").`
- **Cause:** You may have forgotten to provide the component path.
- **Fix:** Ensure you're passing both `{module}` and `{path}`.
```sh
php artisan aaran:livewire Web Home.Index
```

### 2. Error: **Incorrect folder structure (e.g., `Web.sundar` instead of `Web/Sundar`).**
- **Cause:** The module name must use `.` to separate nested modules.
- **Fix:** Use dot notation correctly:
```sh
php artisan aaran:livewire Web.Sundar Home.Index
```

## Conclusion
The `aaran:livewire` command streamlines Livewire component creation in Aaran-BMS. It ensures a well-organized modular structure while automating namespace and folder management. With this tool, developers can efficiently build and maintain Livewire components within their projects.


### **Code Block**
```php
<?php

namespace App\Console\Commands;

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
```

---

## **🔹 Expected Results**
### **Command**
```sh
php artisan aaran:livewire Web.sundar Home.Index
```
✅ **Creates:**  
📂 `Aaran/Web/Sundar/Livewire/Home/Index.php`  
📂 `Aaran/Web/Sundar/Livewire/Home/index.blade.php`  

---

### **Command**
```sh
php artisan aaran:livewire BMS.Web Home.Index
```
✅ **Creates:**  
📂 `Aaran/BMS/Web/Livewire/Home/Index.php`  
📂 `Aaran/BMS/Web/Livewire/Home/index.blade.php`  

---
