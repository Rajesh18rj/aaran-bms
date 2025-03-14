# SetupAaranCommand

### **📜 Updated Command Signature**
```php
protected $signature = 'aaran:setup {name} {--b|base} {--a|all} {--f|force} {--u|update}';
```

### **✅ Features Added**
✔ **`--update` option (`-u`)** Only create missing files, without modifying existing ones.  
✔ **`--force` option (`-f`)** overwrites existing files.  
✔ **If no option is given, it only creates non-existing files.**

---

### **📌 Usage**
```bash
# Create base module (default)
php artisan aaran:setup Auth    

# Base module only (explicitly)
php artisan aaran:setup Auth --b      

# Full module with all files
php artisan aaran:setup Auth --a      

# Force overwrite all files
php artisan aaran:setup Auth --f      

# Update only missing files (without overwriting existing)
php artisan aaran:setup Auth --u      

# Full module + Update only missing files
php artisan aaran:setup Auth --a --u  

# Full module + Overwrite all
php artisan aaran:setup Auth --a --f  
```

## **📁 Directory Structure**
```
Aaran/
 ├── Setup/
 │   ├── Stubs/
 │   │   ├── service-provider.stub
 │   │   ├── api-routes.stub
 │   │   ├── web-routes.stub
 │   │   ├── config.stub
 │   ├── SetupAaranCommand.php
```
---
