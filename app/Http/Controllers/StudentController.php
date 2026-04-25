<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // Check if user can edit/delete
    private function canModify()
    {
        return Auth::check() && Auth::user()->role=='admin';
    }

    // Display all students (Admin + Teacher can see)
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $students = Student::with('profile')->get();
        return view('students.index', compact('students'));
    }

    // Show create form (Admin only)
    public function create()
    {
        if (!$this->canModify()) {
            abort(403, 'Only admin can add students.');
        }
        return view('students.create');
    }

    // Store new student (Admin only)
    public function store(Request $request)
    {
        if (!$this->canModify()) {
            abort(403, 'Only admin can add students.');
        }
        
        // ... rest of store method (same as before)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable|string',
            'class' => 'nullable|string',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
            'blood_group' => 'nullable|string',
        ]);

        $student = Student::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'class' => $validated['class'] ?? null,
            'dob' => $validated['dob'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ]);

        StudentProfile::create([
            'student_id' => $student->id,
            'address' => $validated['address'] ?? null,
            'father_name' => $validated['father_name'] ?? null,
            'mother_name' => $validated['mother_name'] ?? null,
            'emergency_contact' => $validated['emergency_contact'] ?? null,
            'blood_group' => $validated['blood_group'] ?? null,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully!');
    }

    // Show single student (Everyone can see)
    public function show(Student $student)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $student->load('profile', 'courses');
        return view('students.show', compact('student'));
    }

    // Show edit form (Admin only)
    public function edit(Student $student)
    {
        if (!$this->canModify()) {
            abort(403, 'Only admin can edit students.');
        }
        
        $student->load('profile');
        return view('students.edit', compact('student'));
    }

    // Update student (Admin only)
    public function update(Request $request, Student $student)
    {
        if (!$this->canModify()) {
            abort(403, 'Only admin can update students.');
        }
        
        // ... rest of update method (same as before)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string',
            'class' => 'nullable|string',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
            'blood_group' => 'nullable|string',
        ]);

        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'class' => $validated['class'] ?? null,
            'dob' => $validated['dob'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ]);

        if ($student->profile) {
            $student->profile->update([
                'address' => $validated['address'] ?? null,
                'father_name' => $validated['father_name'] ?? null,
                'mother_name' => $validated['mother_name'] ?? null,
                'emergency_contact' => $validated['emergency_contact'] ?? null,
                'blood_group' => $validated['blood_group'] ?? null,
            ]);
        }

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    // Delete student (Admin only)
    public function destroy(Student $student)
    {
        if (!$this->canModify()) {
            abort(403, 'Only admin can delete students.');
        }
        
        $student->delete();
        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
