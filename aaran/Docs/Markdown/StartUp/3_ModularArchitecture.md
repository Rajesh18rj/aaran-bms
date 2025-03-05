# 🅰️🌿 Modular Architecture Setup in Aaran-BMS

This document explains how to set up the modular architecture in Aaran-BMS using an Artisan console command.

## 1️⃣ Why Modular Architecture?
Modular architecture helps keep the codebase structured and scalable by separating features into individual modules.
Each module will contain its own:
- Routes
- Models
- Services
- Livewire Components
- Migrations
- Service Providers

## 2️⃣ Creating the Setup Command
Aaran-BMS includes a **console command** to automate module setup.

Run the following command to create it:

```sh
php artisan make:command AaranSetupCommand --command=aaran:setup
```
Move the generated file to `Aaran/Setup/` and update `composer.json`:

```sh
mkdir -p Aaran/Setup/Console/Commands
```

```sh
mv app/Console/Commands/AaranSetupCommand.php Aaran/Setup/Console/Commands/
```

## 3️⃣ Implementing the Setup Command
Edit `Aaran/Setup/SetupAaranModules.php`:

```php
<?php

namespace Aaran\Setup\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupAaranModules extends Command
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

        $this->info('Modules Base setup complete.');
    }
}
```

## 4️⃣ Running the Setup Command
After saving the file, run:

```sh
php artisan aaran:setup
```

This will generate the following Base structure:

```
📂 Aaran/
├──📂 ActivityLog/
├──📂 Core/
├──📂 Docs/
├──📂 Setup/

```

## Next Steps
- ✅ **Register Service Providers Automatically**
- ✅ **Generate Route Files Dynamically**

Proceed to [Service Provider Registration](service-provider.md).
