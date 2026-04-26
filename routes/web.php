<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return view('welcome');
});

// Guest Routes (No login required)
Route::middleware('guest')->group(function () {
   Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
   Route::post('/login', [LoginController::class, 'login']);
   Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
   Route::post('/register', [RegisterController::class, 'register']);
});

// Protected Routes (Login required)
Route::middleware('auth')->group(function () {

   // Logout
   Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

   // Dashboard Redirect
   Route::get('/dashboard', function () {
      $user = Auth::user();
      if ($user->role === 'admin') {
         return redirect()->route('admin.dashboard');
      } elseif ($user->role === 'teacher') {
         return redirect()->route('teacher.dashboard');
      } else {
         return redirect()->route('student.dashboard');
      }
   });

   // Admin Dashboard
   Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
      ->name('admin.dashboard')
      ->middleware('admin');

   // Teacher Dashboard
   Route::get('/teacher/dashboard', [DashboardController::class, 'teacherDashboard'])
      ->name('teacher.dashboard')
      ->middleware('teacher');

   // Student Dashboard
   Route::get('/student/dashboard', [DashboardController::class, 'studentDashboard'])
      ->name('student.dashboard')
      ->middleware('student');

   // Student CRUD Routes (all 7 methods)
   // Route::resource('students', StudentController::class);

   // OR you can write individually:
   Route::get('/students', [StudentController::class, 'index'])->name('students.index');
   Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
   Route::post('/students', [StudentController::class, 'store'])->name('students.store');
   Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
   Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
   Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
   Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
   //teachers Routues
   Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
   // 2. Show form to create new teacher (CREATE FORM)
   Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
   // 3. Save new teacher to database (STORE DATA)
   Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
   // 4. Display single teacher details (SHOW PAGE)
   Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');
   // 5. Show form to edit teacher (EDIT FORM)
   Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
   // 6. Update teacher in database (UPDATE DATA)
   Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
   // 7. Delete teacher from database (DELETE DATA)
   Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');


   #####################Course Routes#########################

   Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

   // 2. Show form to create new course (CREATE FORM)
   Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');

   // 3. Save new course to database (STORE DATA)
   Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');

   // 4. Display single course details (SHOW PAGE)
   Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

   // 5. Show form to edit course (EDIT FORM)
   Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');

   // 6. Update course in database (UPDATE DATA)
   Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');

   // 7. Delete course from database (DELETE DATA)
   Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

   // 8. Additional route: Manage enrollment (optional)
   Route::get('/courses/{course}/enrollment', [CourseController::class, 'enrollmentForm'])->name('courses.enrollment');
   Route::put('/courses/{course}/enrollment', [CourseController::class, 'updateEnrollment'])->name('courses.update-enrollment');

   // Home route (your existing)
   // Route::get('/', function () {
   //     return view('welcome');
});
// Route::get('/students', function () {
//     return view('students.index');

// });
