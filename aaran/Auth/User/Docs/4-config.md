### **📂 Folder Structure**
```
Aaran/Auth/
│── Config/
│   ├── auth.php              // Authentication settings
│   ├── user.php              // User management settings
│   ├── role.php              // Role settings
│   ├── permissions.php       // Permissions settings
│   ├── user_role.php         // Role-user pivot table settings
│   ├── role_permission.php   // Role-permission pivot table settings
```

These configuration files **fully define** authentication, user roles, permissions, and relationships in your **Aaran-BMS** module. 🚀

---

Here is the **complete set of configuration files** for **Auth, User, Role, Permissions, User_Role, and Role_Permission** in Laravel.
These files are placed in the `Config/` directory inside your **Aaran/Auth** module.
---

## **📌 1️⃣ Auth Configuration (`config/auth.php`)**
```php
return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \Aaran\Auth\User\Models\User::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
```
✅ **Supports API & Web authentication**  
✅ **Uses Eloquent User Model**  
✅ **Defines password reset settings**  

---

## **📌 2️⃣ User Configuration (`config/user.php`)**
```php
return [
    'default_role' => 'user',
    'registration' => true,
    'verification' => true,
    'password_min_length' => 6,
    'allow_password_reset' => true,
    'allow_social_login' => true,

    'avatar' => [
        'default' => 'storage/avatars/default.png',
        'storage_disk' => 'public',
        'allowed_mimes' => ['jpg', 'png', 'jpeg'],
        'max_size' => 2048,
    ],
];
```
✅ **Controls user registration, verification, and security**  
✅ **Supports social logins and password reset**  
✅ **Avatar settings for profile pictures**  

---

## **📌 3️⃣ Role Configuration (`config/role.php`)**
```php
return [
    'roles' => [
        'admin' => [
            'name' => 'Administrator',
            'permissions' => ['manage-users', 'manage-roles', 'manage-permissions'],
        ],
        'moderator' => [
            'name' => 'Moderator',
            'permissions' => ['manage-users'],
        ],
        'user' => [
            'name' => 'User',
            'permissions' => [],
        ],
    ],

    'default_role' => 'user',

    'super_admin' => 'admin',
];
```
✅ **Defines roles (`admin`, `moderator`, `user`)**  
✅ **Assigns default roles to new users**  
✅ **Super Admin role has all permissions**  

---

## **📌 4️⃣ Permissions Configuration (`config/permissions.php`)**
```php
return [
    'permissions' => [
        'manage-users' => 'Can create, update, or delete users',
        'manage-roles' => 'Can assign roles to users',
        'manage-permissions' => 'Can define new permissions',
        'view-dashboard' => 'Can view admin dashboard',
        'edit-profile' => 'Can edit own profile',
    ],
];
```
✅ **Defines all available permissions**  
✅ **Permissions can be dynamically assigned**  

---

## **📌 5️⃣ User-Role Relationship (`config/user_role.php`)**
```php
return [
    'table' => 'role_user',

    'columns' => [
        'user_id' => [
            'type' => 'integer',
            'index' => true,
            'foreign' => 'users.id',
            'onDelete' => 'cascade',
        ],
        'role_id' => [
            'type' => 'integer',
            'index' => true,
            'foreign' => 'roles.id',
            'onDelete' => 'cascade',
        ],
    ],
];
```
✅ **Defines the pivot table `role_user`**  
✅ **Links users to roles using foreign keys**  

---

## **📌 6️⃣ Role-Permission Relationship (`config/role_permission.php`)**
```php
return [
    'table' => 'permission_role',

    'columns' => [
        'role_id' => [
            'type' => 'integer',
            'index' => true,
            'foreign' => 'roles.id',
            'onDelete' => 'cascade',
        ],
        'permission_id' => [
            'type' => 'integer',
            'index' => true,
            'foreign' => 'permissions.id',
            'onDelete' => 'cascade',
        ],
    ],
];
```
✅ **Defines the pivot table `permission_role`**  
✅ **Links roles to permissions using foreign keys**  

---


Great question! Here’s how these configuration files are **used** throughout your **Aaran-BMS** module.

---

## **📌 1️⃣ `config/auth.php` Usage**
This is **Laravel’s built-in authentication config**, which is automatically used by Laravel’s authentication system.

### **Example: Using Guard from Config**
```php
use Illuminate\Support\Facades\Auth;

// Authenticate user using the default guard
$user = Auth::guard(config('auth.defaults.guard'))->user();
```

### **Example: Using Custom User Provider**
```php
$provider = config('auth.providers.users.model');
$user = new $provider();
```

---
## **📌 2️⃣ `config/user.php` Usage**
Controls user-related settings like **registration, password policy, and avatars**.

### **Example: Enforcing Password Policy in Registration**
```php
$request->validate([
    'password' => 'required|min:' . config('user.password_min_length'),
]);
```

### **Example: Using Avatar Configuration**
```php
$avatarPath = config('user.avatar.default');
```

---
## **📌 3️⃣ `config/role.php` Usage**
Defines **roles and default role assignment**.

### **Example: Assigning a Default Role**
```php
use Aaran\Auth\User\Models\Role;

$user->role()->attach(Role::where('name', config('role.default_role'))->first());
```

### **Example: Checking if User is Super Admin**
```php
if ($user->role->name === config('role.super_admin')) {
    // User has full access
}
```

---
## **📌 4️⃣ `config/permissions.php` Usage**
Defines **all available permissions** in the system.

### **Example: Checking User Permissions**
```php
if ($user->hasPermission(config('permissions.manage-users'))) {
    // Allow user management
}
```

### **Example: Dynamically Listing Permissions**
```php
foreach (config('permissions.permissions') as $key => $description) {
    echo "Permission: $key - $description";
}
```

---
## **📌 5️⃣ `config/user_role.php` Usage**
Defines **role-user pivot table settings**.

### **Example: Defining Pivot Table in Migration**
```php
Schema::create(config('user_role.table'), function (Blueprint $table) {
    $table->foreignId(config('user_role.columns.user_id.foreign'))
          ->constrained()
          ->onDelete(config('user_role.columns.user_id.onDelete'));

    $table->foreignId(config('user_role.columns.role_id.foreign'))
          ->constrained()
          ->onDelete(config('user_role.columns.role_id.onDelete'));
});
```

---
## **📌 6️⃣ `config/role_permission.php` Usage**
Defines **role-permission pivot table settings**.

### **Example: Defining Role-Permission Pivot Table in Migration**
```php
Schema::create(config('role_permission.table'), function (Blueprint $table) {
    $table->foreignId(config('role_permission.columns.role_id.foreign'))
          ->constrained()
          ->onDelete(config('role_permission.columns.role_id.onDelete'));

    $table->foreignId(config('role_permission.columns.permission_id.foreign'))
          ->constrained()
          ->onDelete(config('role_permission.columns.permission_id.onDelete'));
});
```

---
### **✅ Summary**
| Config File            | Purpose | Example Usage |
|------------------------|---------|--------------|
| `config/auth.php` | Authentication settings | `Auth::guard(config('auth.defaults.guard'))` |
| `config/user.php` | User settings (password policy, avatars) | `config('user.password_min_length')` |
| `config/role.php` | Defines roles and default role assignment | `config('role.default_role')` |
| `config/permissions.php` | Defines available permissions | `config('permissions.manage-users')` |
| `config/user_role.php` | Defines role-user pivot table settings | Used in migrations |
| `config/role_permission.php` | Defines role-permission pivot table settings | Used in migrations |

These config files **centralize settings** so that everything remains **consistent and easy to manage** throughout your Laravel application.

### **📌 Difference Between Using Config Files vs. Database Tables in Laravel**

When managing roles, permissions, users, and authentication, you can **store** this data either in **config files** or **database tables**. Below is a comparison of both approaches:

---

## **🔹 Config Files (`config/*.php`)**
### **✅ When to Use:**
- When data is **static** and **does not change often**.
- When you need **global settings** that are used across the application.
- When performance is a priority (config files load faster than database queries).
- When data should be **easily accessible** without making a database call.

### **🛠 Example: Defining Roles in `config/role.php`**
```php
return [
    'default_role' => 'user',
    'super_admin' => 'admin',
    'roles' => [
        'admin' => 'Administrator',
        'editor' => 'Editor',
        'user' => 'Regular User',
    ],
];
```

### **📌 How to Use in Code**
```php
$defaultRole = config('role.default_role');  // Output: "user"
$roles = config('role.roles');  // Returns ['admin' => 'Administrator', 'editor' => 'Editor', 'user' => 'Regular User']
```

### **⚡ Pros of Using Config Files:**
✔ **Performance:** No database queries; faster access.  
✔ **Security:** Less risk of data manipulation since it’s not stored in the DB.  
✔ **Global Access:** Easily accessible anywhere using `config()` helper.  
✔ **Easy to Modify:** Developers can edit the config file without modifying the database.

### **❌ Cons of Using Config Files:**
✖ **No Dynamic Updates:** Changes require a code deployment (`config:cache` must be cleared).  
✖ **Not Scalable:** Cannot be used if roles and permissions need to change frequently.

---

## **🔹 Database Tables**
### **✅ When to Use:**
- When the data is **dynamic** and **changes frequently**.
- When you need to **allow admins** to manage roles, permissions, and users via UI.
- When relationships between users, roles, and permissions are required.
- When permissions need to be checked dynamically.

### **🛠 Example: `roles` Table Schema**
```php
Schema::create('roles', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->timestamps();
});
```

### **📌 How to Use in Code**
```php
use Aaran\Auth\User\Models\Role;

$adminRole = Role::where('name', 'admin')->first();
echo $adminRole->name; // Output: "admin"
```

### **⚡ Pros of Using Database Tables:**
✔ **Dynamic:** Data can be updated via UI (e.g., admin dashboard).  
✔ **Scalable:** Suitable for applications where roles & permissions grow over time.  
✔ **Relationships:** Can be used with `hasMany()`, `belongsToMany()` relationships.  
✔ **API & Admin Control:** Admins can modify roles/permissions without changing code.

### **❌ Cons of Using Database Tables:**
✖ **Performance Overhead:** Requires queries to retrieve roles/permissions.  
✖ **Security Risks:** Can be manipulated if not secured properly.  
✖ **Dependency on Database:** Cannot access data before database migration is done.

---

## **🆚 Comparison Table**
| Feature | Config File (`config/*.php`) | Database Table |
|---------|-----------------|----------------|
| **Performance** | ✅ Faster (No DB queries) | ❌ Slower (Needs queries) |
| **Scalability** | ❌ Limited | ✅ High (Can grow dynamically) |
| **Security** | ✅ Secure (Not user-editable) | ❌ Risky if not protected |
| **Admin Manageable?** | ❌ No | ✅ Yes (via UI) |
| **Dynamic Updates?** | ❌ No (Requires code changes) | ✅ Yes (Editable via database) |
| **Relationships (Eloquent)** | ❌ No | ✅ Yes |
| **Usage in Code** | `config('role.default_role')` | `Role::where('name', 'admin')->first()` |

---

## **📌 Which One Should You Use?**
✅ **Use Config Files** when:
- You have **static** settings (default roles, permission names).
- You want **better performance** with no DB queries.
- You don’t need roles/permissions to change dynamically.

✅ **Use Database Tables** when:
- Roles & permissions **must be editable** from an admin panel.
- You need **dynamic** access control.
- You require **relationships** (users, roles, permissions).

💡 **Best Practice:** Use **config files for default values** and **database tables for dynamic storage**.  
For example:
- Store **default roles & permissions** in `config/role.php`.
- Fetch **user roles dynamically** from the database.

---

Let me know if you need a deeper implementation! 🚀
