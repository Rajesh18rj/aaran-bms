# Aaran/Auth/User - User Module Documentation

## Overview

The **User Module** in Aaran-BMS provides a robust **Role-Based Access Control (RBAC)** system, API support with **Sanctum authentication**, middleware, Livewire components, Blade views, database migrations, repositories, service classes, controllers, policies, request validation, and Pest tests.

## Folder Structure

```
Aaran/ 🚀
│── Auth/ 🔐
│   ├── User/ 👤 (User Management with RBAC ✅)
│   │   ├── Config/ ⚙️ (User module configuration)
│   │   ├── Database/ 🗄️
│   │   │   ├── Migrations/ 📜 (Database migrations)
│   │   │   ├── Seeders/ 🌱 (Database seeders)
│   │   ├── Http/ 🌐
│   │   │   ├── Controllers/ 🎛️ (API controllers)
│   │   │   ├── Middleware/ 🚦 (Custom middleware)
│   │   │   ├── Requests/ 📩 (Form request validation)
│   │   ├── Livewire/ ⚡ (Livewire components)
│   │   ├── Models/ 📦 (Eloquent models)
│   │   ├── Policies/ 🔒 (Authorization policies)
│   │   ├── Repositories/ 🏛️ (Repository pattern for user management)
│   │   ├── Routes/ 🛤️
│   │   │   ├── api.php 📡 (API routes)
│   │   │   ├── web.php 🌍 (Web routes)
│   │   ├── Services/ 🔧 (Service layer for business logic)
│   │   ├── Tests/ 🧪 (Pest tests)
│   │   ├── Views/ 🎨 (Blade views for UI)
│   │   ├── UserServiceProvider.php 📦 (Service provider)
```

## Features

- **RBAC (Role-Based Access Control)** ✅
- **API Support with Sanctum Authentication** 🔑
- **Middleware for Permission Handling** 🚦
- **Livewire Forms for User Management** ⚡
- **Repository Pattern for Data Access** 🏛️
- **Eloquent Models for User, Role, and Permission** 📦
- **User Authorization Policies** 🔒
- **Pest Tests for API & Feature Testing** 🧪
- **Blade UI Components for User Forms** 🎨
- **Automatic Seeder Execution** 🌱

## Database Tables 🗃️

| Table Name        | Description               |
| ----------------- | ------------------------- |
| `users`           | Stores user details       |
| `roles`           | Stores role names         |
| `permissions`     | Stores permission names   |
| `role_user`       | Maps users to roles       |
| `permission_role` | Maps roles to permissions |

## Installation

1. **Run Migrations** 📜
   ```sh
   php artisan migrate
   ```
2. **Seed Default Roles & Permissions** 🌱
   ```sh
   php artisan db:seed --class=Aaran\Auth\User\Database\Seeders\RoleSeeder
   php artisan db:seed --class=Aaran\Auth\User\Database\Seeders\PermissionSeeder
   ```
3. **Publish Configuration (Optional)** ⚙️
   ```sh
   php artisan vendor:publish --tag=user-config
   ```

## API Endpoints 📡

| Method | Endpoint     | Description       |
| ------ | ------------ | ----------------- |
| `GET`  | `/api/users` | Fetch all users   |
| `POST` | `/api/users` | Create a new user |

## Web Routes 🌍

| Method | Route          | Controller | Description    |
| ------ | -------------- | ---------- | -------------- |
| `GET`  | `/users`       | `index()`  | Show all users |
| `POST` | `/users/store` | `store()`  | Store new user |

## Middleware 🚦

- `EnsureUserHasPermission`: Checks if a user has the required permission before accessing a route.

## Livewire Components ⚡

- `UserForm`: Livewire-powered user creation form.

## Service Classes 🔧

- `UserService`: Handles complex user-related operations.

## Repository Pattern 🏛️

- `UserRepository`: Abstracted data access layer.

## Tests 🧪

- API and feature tests using Pest.

## Conclusion

The **User Module** provides an enterprise-level user management solution with security, scalability, and flexibility in mind. 🚀
