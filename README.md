# TechSimple ICT — Training Management System

A dynamic Training Management System built with **PHP + MySQL** backend and a clean HTML/JS frontend.

## 🚀 Features
- Browse and filter training programs
- Online registration with deadline enforcement
- Discount/offer system with real-time pricing
- Admin panel with full CRUD for trainings and offers
- Admin authentication (Gmail login)
- Forgot password / reset password

## 🗂️ Project Structure
```
├── index.php              # Admin dashboard (protected)
├── trainings.php          # Public training listing
├── training-detail.php    # Training detail page
├── register.php           # Student registration form
├── login.php              # Admin login
├── signup.php             # Admin signup
├── forgot-password.php    # Admin password reset
├── api/
│   ├── db.php             # ⚠️ NOT in Git — copy from db.example.php
│   ├── db.example.php     # DB credentials template
│   ├── login.php          # Admin login API
│   ├── signup.php         # Admin signup API
│   ├── register.php       # Student registration API
│   ├── get_trainings.php  # Public trainings API
│   ├── get_training_details.php
│   ├── get_classifications.php
│   ├── reset_password.php
│   ├── logout.php
│   └── admin/             # Protected admin APIs
│       ├── trainings.php
│       ├── offers.php
│       └── registrations.php
├── js/
│   ├── data.js            # API communication layer
│   └── logic.js           # Price calculations & date logic
├── schema.sql             # Database schema (import in phpMyAdmin)
└── styles.css
```

## 🛠️ Local Setup (XAMPP)
1. Copy project folder to `htdocs/`
2. Import `schema.sql` in phpMyAdmin
3. Copy `api/db.example.php` → `api/db.php` and fill in credentials:
   ```php
   $host = 'localhost';
   $db   = 'training_db';
   $user = 'root';
   $pass = '';
   ```
4. Visit `http://localhost/Techsimpleict.com/trainings.php`
5. Sign up as admin at `signup.php`, then login at `login.php`

## 🌐 InfinityFree Deployment
1. Create account at [infinityfree.com](https://infinityfree.com)
2. Create a MySQL database from vPanel → note host, dbname, user, password
3. Import `schema.sql` via phpMyAdmin (no CREATE DATABASE needed — already removed)
4. Copy `api/db.example.php` → `api/db.php` and fill InfinityFree MySQL credentials
5. Upload all files to `htdocs/` via File Manager or FTP
6. Visit your domain!

## ⚙️ Tech Stack
- **Frontend:** HTML5, CSS3, Vanilla JS (ES6+)
- **Backend:** PHP 7.4+ (compatible with InfinityFree)
- **Database:** MySQL
- **Auth:** PHP Sessions + `password_hash()`
