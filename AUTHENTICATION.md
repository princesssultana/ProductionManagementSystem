# Authentication System Documentation

## Overview
A complete authentication system has been implemented for the Production Management System with user roles and access control.

## Features Implemented

### 1. User Authentication
- ✅ Login functionality with email and password
- ✅ Registration for new users
- ✅ Logout functionality
- ✅ Remember me functionality
- ✅ Session management

### 2. User Roles
- **Admin**: Full access to all system features
- **User**: Standard access to production orders and medicine management

### 3. Authentication Guards
- Session-based authentication
- Protected routes with middleware
- Automatic redirect to login for unauthenticated users

---

## Files Created/Modified

### Controllers
**New File:** `app/Http/Controllers/AuthController.php`
- `showLoginForm()`: Display login page
- `login()`: Handle login request
- `showRegisterForm()`: Display registration page
- `register()`: Handle registration request
- `logout()`: Handle logout

### Models
**Modified:** `app/Models/User.php`
- Added `role` field to fillable array
- Added `isAdmin()` method to check if user is admin
- Added `isUser()` method to check if user is regular user

### Database
**New Migration:** `database/migrations/2026_01_21_000000_add_role_to_users_table.php`
- Adds `role` enum column to users table
- Supports: 'admin', 'user' roles
- Default: 'user'

**New Seeder:** `database/seeders/UserSeeder.php`
- Creates admin user
- Creates regular user

**Modified:** `database/seeders/DatabaseSeeder.php`
- Calls UserSeeder in the run() method

### Views
**New File:** `resources/views/auth/login.blade.php`
- Login form with email and password
- Remember me checkbox
- Link to registration page
- Demo credentials display

**New File:** `resources/views/auth/register.blade.php`
- Registration form
- Name, email, password, and password confirmation
- Link to login page

**Modified:** `resources/views/home.blade.php`
- Dashboard showing system statistics
- Different welcome message for authenticated/unauthenticated users
- Quick access cards for medicines, orders, materials

**Modified:** `resources/views/master.blade.php`
- Conditional sidebar display (only for authenticated users)
- Responsive layout for authenticated vs unauthenticated views

**Modified:** `resources/views/partials/sidebar.blade.php`
- Added user info display
- Added logout button
- Shows logged-in user name and email

### Routes
**Modified:** `routes/web.php`
- Authentication routes (login, register, logout)
- Protected routes with `auth` middleware
- All system routes now require authentication (except login/register/home)

---

## Default Users

### Admin Account
```
Email: admin@example.com
Password: admin123456
Role: Admin
```

### Regular User Account
```
Email: user@example.com
Password: user123456
Role: User
```

---

## Setup Instructions

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Run Seeders
```bash
php artisan db:seed
```

This will create:
- Admin user (admin@example.com)
- Regular user (user@example.com)
- Factory settings

### 3. Start the Application
```bash
php artisan serve
```

### 4. Access the System
- Open `http://localhost:8000`
- Click "Login" to sign in
- Use the credentials above

---

## Usage

### For Admin Users
1. Log in with admin credentials
2. Access all features including:
   - Medicine management
   - Production orders
   - Packaging materials
   - Stock management
   - Reports
   - Factory settings

### For Regular Users
1. Log in with user credentials
2. Can access:
   - Production orders
   - Medicine viewing
   - Packaging materials viewing
   - Basic reporting

### Creating New Users
1. Click "Create Account" on login page
2. Fill in registration form
3. Account will be created with "user" role by default

### Logging Out
- Click "Sign Out" in the sidebar
- User session will be invalidated
- Redirected to home page

---

## Authentication Flow

```
1. User visits website
   ├─ If authenticated → Show dashboard with sidebar
   └─ If not authenticated → Show home page with login/register buttons

2. User clicks login
   ├─ Enter email and password
   ├─ System validates credentials
   ├─ If valid → Create session and redirect to dashboard
   └─ If invalid → Show error and redirect to login

3. User accesses protected route
   ├─ Middleware checks if authenticated
   ├─ If authenticated → Grant access
   └─ If not authenticated → Redirect to login

4. User clicks logout
   ├─ Session is invalidated
   ├─ Token regenerated for security
   └─ Redirect to home page
```

---

## Security Features

✅ Passwords are hashed using Laravel's default hasher
✅ CSRF protection on all forms
✅ Session regeneration on login
✅ Session invalidation on logout
✅ Protected routes with middleware
✅ Role-based access control
✅ Remember me functionality with secure tokens

---

## Database Schema

### Users Table
```
id (integer, primary key)
name (string)
email (string, unique)
email_verified_at (timestamp, nullable)
password (string)
role (enum: 'admin', 'user') - DEFAULT: 'user'
remember_token (string, nullable)
created_at (timestamp)
updated_at (timestamp)
```

---

## Common Issues & Solutions

### Issue: "Unauthenticated" error on all routes
**Solution:** Make sure you're logged in. If not, click login and enter credentials.

### Issue: "The specified user does not exist"
**Solution:** Make sure you're using the correct email and password from the seeded accounts.

### Issue: Cannot access certain pages after login
**Solution:** Check your user role. Some pages may require admin privileges.

### Issue: Session expires quickly
**Solution:** Check `config/session.php` and adjust the `lifetime` value (in minutes).

---

## Extending Authentication

### To Add More Roles
1. Modify migration to add new role to enum:
```php
$table->enum('role', ['admin', 'user', 'manager'])->default('user');
```

2. Add methods to User model:
```php
public function isManager(): bool
{
    return $this->role === 'manager';
}
```

### To Add Role-Based Routes
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin-only routes
});
```

### To Add User Permissions
Create a separate permissions table and pivot table for more granular control.

---

## Testing the System

1. **Test Admin Login**
   - Email: admin@example.com
   - Password: admin123456
   - Verify you see admin dashboard

2. **Test User Login**
   - Email: user@example.com
   - Password: user123456
   - Verify you see user dashboard

3. **Test Registration**
   - Click "Create Account"
   - Fill in form with new details
   - Verify account is created with 'user' role

4. **Test Logout**
   - Click "Sign Out" in sidebar
   - Verify redirect to home page
   - Try accessing protected route without logging in

---

## Support & Maintenance

For questions or issues:
1. Check the Laravel authentication documentation
2. Review the code comments in AuthController
3. Check database for user records
4. Verify migrations have run successfully

---

**Last Updated:** January 21, 2026
**Version:** 1.0.0
