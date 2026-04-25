<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        $teachers = Teacher::all();
        $students = Student::all();  // ✅ Add this line
        return view('auth.register', compact('teachers', 'students'));
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,teacher,student',
        ];
        
        // Add conditional validation for teacher and student
        if ($request->role === 'teacher') {
            $rules['teacher_id'] = 'required|exists:teachers,id';
        }
        
        if ($request->role === 'student') {
            $rules['student_id'] = 'required|exists:students,id';
        }
        
        $request->validate($rules);

        $studentId = null;
        $teacherId = null;

        // For TEACHER: Link to existing teacher
        if ($request->role === 'teacher') {
            $teacherId = $request->teacher_id;
        } 
        // For STUDENT: Link to existing student (NOT create new)
        elseif ($request->role === 'student') {
            $studentId = $request->student_id;
        }
        // For ADMIN: No student or teacher link needed

        // Create user account only
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'student_id' => $studentId,
            'teacher_id' => $teacherId,
        ]);

        // Auto login after registration
        Auth::login($user);

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isTeacher()) {
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
}
