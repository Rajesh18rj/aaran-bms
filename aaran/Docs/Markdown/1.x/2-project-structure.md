# Project Structure for BMS

app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   ├── Admin/
│   │   ├── User/
│   │   ├── Finance/
│   │   ├── Inventory/
│   │   ├── CRM/
│   ├── Livewire/
│   │   ├── Dashboard/
│   │   ├── Users/
│   │   ├── Finance/
│   │   ├── Inventory/
│   │   ├── CRM/
│   ├── Middleware/
│   ├── Requests/
│   ├── Services/
│   ├── Repositories/
├── Models/
│   ├── User.php
│   ├── Role.php
│   ├── Permission.php
│   ├── Invoice.php
│   ├── Product.php
│   ├── Customer.php
│   ├── Employee.php
│   ├── Payroll.php
├── Policies/
├── View/ (Blade templates)
│   ├── layouts/
│   ├── dashboard/
│   ├── users/
│   ├── finance/
│   ├── inventory/
│   ├── crm/
├── Components/
├── Helpers/
database/
├── migrations/
├── seeders/
routes/
├── web.php
├── api.php
├── admin.php
config/
resources/
├── js/ (Alpine.js, Livewire assets)
├── sass/ (Styling)
