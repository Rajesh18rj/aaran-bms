# **User module** in **Aaran-BMS**

---

### ✅ **1. User Model Enhancements**
✔ Ensure `User.php` is inside `Aaran/Auth/Identity/Models/User.php`  
✔ Implements `MustVerifyEmail`  
✔ Implements `HasProfilePhoto` (custom profile photo logic)  
✔ Includes `tenant_id` for future multi-tenancy

---

### ✅ **2. Database & Migrations**
✔ `users` table: No `role_id` (roles are managed separately)  
✔ Add `tenant_id` to `users` table  
✔ Ensure migration timestamps are correct

---

### ✅ **3. Repository Pattern**
✔ Create `UserRepository.php` inside `Repositories/`  
✔ Methods: `find`, `create`, `update`, `delete`, `paginate`, etc.

---

### ✅ **4. Service Layer**
✔ Create `UserService.php` inside `Services/`  
✔ Use `UserRepository` inside `UserService`  
✔ Implement business logic inside service methods

---

### ✅ **5. API & Web Controllers**
✔ Create `UserController.php` inside `Http/Controllers/`  
✔ Separate API & Web logic  
✔ Ensure route model binding works

---

### ✅ **6. Request Validation**
✔ Create `StoreUserRequest.php` & `UpdateUserRequest.php`  
✔ Use `sometimes` for optional fields  
✔ Validate `tenant_id`, `email`, `password`, etc.

---

### ✅ **7. Policies & Authorization**
✔ `UserPolicy.php` inside `Policies/`  
✔ Register inside `AuthServiceProvider`  
✔ Define methods: `view`, `update`, `delete`, etc.  
✔ Implement custom middleware for role-based access

---

### ✅ **8. Middleware**
✔ `RoleMiddleware.php` (checks role access)  
✔ `PermissionMiddleware.php` (checks permission access)  
✔ Ensure automatic registration in `IdentityServiceProvider`

---

### ✅ **9. Livewire Components (Modular UI)**
✔ `UserTable.php` inside `Livewire/`  
✔ `user-table.blade.php` inside `Views/livewire/`  
✔ Ensure correct namespace: `Aaran\Auth\Identity\Livewire\UserTable`  
✔ Ensure Livewire 3 `$dispatch()` is used instead of `$emit()`

---

### ✅ **10. Routes & Auto-Loading**
✔ `web.php` for web routes  
✔ `api.php` for API routes  
✔ Ensure routes auto-load inside `IdentityServiceProvider`

---

### ✅ **11. Event & Listener System**
✔ `UserCreated` event  
✔ `SendUserWelcomeEmail` listener  
✔ Ensure registered inside `EventServiceProvider`

---

### ✅ **12. Service Provider Optimization**
✔ Merge multiple providers if necessary  
✔ Keep `AuthServiceProvider`, `EventServiceProvider`, and `IdentityServiceProvider`  
✔ Remove `UserServiceProvider` if it's redundant

---

### ✅ **13. Testing**
✔ `UserTest.php` inside `Tests/Feature/`  
✔ `UserServiceTest.php` inside `Tests/Unit/`  
✔ Use Pest for testing

---

This checklist will help you stay **focused** and systematically complete each part of the User module. Let me know if you need refinements or explanations! 🚀🔥
