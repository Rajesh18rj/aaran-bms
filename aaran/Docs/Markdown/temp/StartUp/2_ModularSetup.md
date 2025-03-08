# 🅰️🌿 Aaran-BMS Installation Guide


## 5️⃣ Create `Aaran` Folder and Configure Autoload
Create the `Aaran` folder:

```sh
mkdir -p Aaran
```

Update `composer.json`:

```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Aaran\\": "Aaran/"
    }
}
```
Dump autoload to apply changes:

```sh
composer dump-autoload
```

## Next Steps
Now that the base setup is ready, proceed with [Modular Architecture Setup](modular-architecture.md).
