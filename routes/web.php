<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController; 
use App\Http\Controllers\TeacherController;
 
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


// Teacher CRUD Routes
//Route::resource('teachers', TeacherController::class);
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


// Home route (your existing) 
Route::get('/', function () {
   return view('welcome');
});

