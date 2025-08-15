STUDENT PORTAL — LARAVEL (BLADE+BREEZE) — DROP-IN PACKAGE
========================================================

This ZIP contains ONLY the custom files for the Student Portal. 
First, you install a fresh Laravel app with Breeze, then extract this ZIP over it.

Quick Steps
-----------
1) Create Laravel app
   composer create-project laravel/laravel student-portal
   cd student-portal

2) Install Breeze (Blade)
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   npm install
   npm run build

3) Configure database in .env (phpMyAdmin/MySQL):
   DB_DATABASE=student_portal
   DB_USERNAME=root
   DB_PASSWORD= (set it if you have one)

   Create database 'student_portal' in phpMyAdmin.

4) Storage symlink
   php artisan storage:link

5) Copy/Extract this ZIP over your project root (allow overwrite for same paths).

6) Migrate + Seed
   php artisan migrate
   php artisan db:seed --class=AdminUserSeeder
   php artisan db:seed --class=DemoStudentsSeeder

7) Serve
   php artisan serve
   Open http://127.0.0.1:8000

Login & Roles
-------------
- Landing page shows buttons: Login/Signup as Student or Teacher.
- During registration, choose role (Student or Teacher).
- A default teacher is seeded:
  Email: admin@example.com
  Password: password
  Role: teacher

Features
--------
Students:
- Edit profile (name, student_id, phone, department)
- View assignments, submit work (file + message)
- View their submissions & statuses
- View published results
- Send message to teacher/admin

Teachers:
- Dashboard: students list, assignments with counts, inbox
- Create/Edit/Delete assignments (file upload)
- View submissions for each assignment, grade with feedback
- Publish results for any student
- View & reply to messages

Tables
------
users, assignments, submissions, results, messages

File Uploads
------------
- Assignments and submissions are stored on the 'public' disk (storage/app/public)
- Ensure 'php artisan storage:link' is run.

If you see permission or 403 errors, ensure you're logged in as correct role.

IMPORTANT: Add the RoleMiddleware to app/Http/Kernel.php in $routeMiddleware array:
  'role' => App\Http\Middleware\RoleMiddleware::class,
