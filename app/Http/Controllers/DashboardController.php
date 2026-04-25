<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Admin Dashboard
    public function adminDashboard()
    {
        $stats = [
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'courses' => Course::count(),
            'enrollments' => DB::table('course_student')->count(),
        ];
        
        $recentStudents = Student::latest()->take(5)->get();
        $recentCourses = Course::with('teacher')->latest()->take(5)->get();
        
        return view('dashboard.admin', compact('stats', 'recentStudents', 'recentCourses'));
    }

    // Teacher Dashboard
    public function teacherDashboard()
    {
        $user = Auth::user();
        $teacher = $user->teacher;
        
        $courses = [];
        if ($teacher) {
            $courses = Course::where('teacher_id', $teacher->id)->with('students')->get();
        }
        
        $totalStudents = 0;
        foreach ($courses as $course) {
            $totalStudents += $course->students->count();
        }
        
        return view('dashboard.teacher', compact('teacher', 'courses', 'totalStudents'));
    }

    // Student Dashboard
    public function studentDashboard()
    {
        $user = Auth::user();
        $student = $user->student;
        
        $enrolledCourses = [];
        if ($student) {
            $enrolledCourses = $student->courses()->with('teacher')->get();
        }
        
        return view('dashboard.student', compact('student', 'enrolledCourses'));
    }
}
