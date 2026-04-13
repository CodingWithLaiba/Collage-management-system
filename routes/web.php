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


Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index'); 
Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create'); 
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store'); 
Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show'); 
Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit'); 
Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update'); 
Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

// Home route (your existing) 
Route::get('/', function () {
    return '
        <h1>Welcome Page</h1>
        <a href="/students">
            <button style="padding:10px 20px; font-size:16px; cursor:pointer;">
                Go to Collage Management System
            </button>
        </a>
    ';
});

