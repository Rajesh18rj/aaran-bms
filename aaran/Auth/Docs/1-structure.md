# **Structure**📁📜✨

---

## **📂 Aaran/Auth - Folder Structure**
```
📂 Aaran/ 🚀
│──📂 Auth/ 🔐
│   ├──📂 User/ 👤 (User Management with RBAC ✅)
│   ├──📂 MFA/ 🔑 (Multi-Factor Authentication)
│   ├──📂 OAuth/ 🔗 (OAuth & Social Logins)
│   ├──📂 Session/ 🔄 (Session Management & Authentication)
│   ├──📂 PasswordReset/ 🔄 (Forgot Password & Recovery)
│   ├──📂 EmailVerification/ 📧 (Email Confirmation)
│   ├──📂 Logs/ 📜 (Authentication Logs & Auditing)

```

| **Category**       |   | **Description** |
|-------------------|------------|----------------|
| **User Management** | 👤 | User-related modules (RBAC, profiles, etc.) |
| **Multi-Factor Authentication (MFA)** | 🔑 | MFA security (TOTP, SMS, Email verification) |
| **OAuth & Social Logins** | 🔗 | OAuth 2.0 & social authentication (Google, Facebook, etc.) |
| **Session Management** | 🔄 | Authentication sessions & active device tracking |
| **Password Reset** | 🔄 | Forgot password & account recovery |
| **Email Verification** | 📧 | Email confirmation & validation system |
| **Authentication Logs** | 📜 | Security logs & auditing |

This is complete folder structure for Aaran/Auth/, ensuring a well-structured authentication
system RBAC, MFA, OAuth, Session Management, and Security Auditing. 🚀🔐


# 📂 Aaran/Auth - Modules Folder Structure
```
📂 Aaran/ 🚀
│──📂 Auth/ 🔐
│   ├──📂 Modules/ 👤 (Modules we create : eg User)
│   │   ├──📂 Config/ ⚙️
│   │   ├──📂 Database/ 🗄️
│   │   │   ├──📂 Migrations/ 📜
│   │   │   ├──📂 Seeders/ 🌱
│   │   ├──📂 Http/ 🌍
│   │   │   ├──📂 Controllers/ 🎮
│   │   │   ├──📂 Middleware/ 🛡️
│   │   │   ├──📂 Requests/ 📩
│   │   ├──📂 Services/ 🛠️
│   │   ├──📂 Repositories/ 💾
│   │   ├──📂 Livewire/ ⚡ (Livewire Components)
│   │   ├──📂 Views/ 👀
│   │   ├──📂 Routes/ 🛤️ (API + Web)
│   │   ├──📂 Policies/ 🏛️ (RBAC Authorization)
│   │   ├──📂 Tests/ 🧪
```
This is complete folder structure for under Modules,

Here’s a refined **emoji legend for tables** to maintain consistency across documentation and folder structures:

| **Category**               |     | **Description** |
|----------------------------|-----|----------------|
| **Configurations**         | ⚙️  | Authentication settings & configuration files |
| **Database**               | 🗄️  |  |
| **Migrations**             | 📜  | Database schema changes |
| **Seeders**                | 🌱  | Initial data population |
| **Http**                   | 🌍  |  |
| **Controllers**            | 🎮  | Handling authentication requests |
| **Middleware**             | 🛡️ | Security & access control middleware |
| **Services**               | 🛠️ | Business logic and authentication handling |
| **Repositories**           | 💾  | Data persistence layer |
| **Livewire Components**    | ⚡   | Livewire-based authentication modules |
| **Views (Blade/Livewire)** | 👀  | UI components for authentication |
| **Routes**                 | 🛤️ | API & Web routes |
| **Policies**               | 🏛️ | Laravel Gates & authorization logic |
| **Tests (Pest/PHPUnit)**   | 🧪  | Authentication unit & feature tests |

