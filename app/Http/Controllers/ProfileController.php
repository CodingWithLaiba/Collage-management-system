<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $student = $user->student;
        
        if (!$student) {
            abort(404, 'Student profile not found.');
        }
        
        $student->load('profile', 'courses');
        
        return view('students.show', compact('student'));
    }
    
    public function myCourses()
    {
        $user = Auth::user();
        $student = $user->student;
        
        if (!$student) {
            abort(404, 'Student profile not found.');
        }
        
        $courses = $student->courses()->with('teacher')->get();
        
        return view('dashboard.student-courses', compact('courses'));
    }
}
