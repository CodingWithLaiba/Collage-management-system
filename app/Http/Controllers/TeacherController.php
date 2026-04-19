<?php

namespace App\Http\Controllers;
use App\Models\Teacher;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
     // Display list of all teachers
    public function index()
    {
        $teachers = Teacher::get();

        // $teachers = Teacher::with('courses')->get();
        return view('teachers.index', compact('teachers'));
    }

    // Show form to create new teacher
    public function create()
    {
        return view('teachers.create');
    }

    // Store new teacher in database
    public function store(Request $request)
    {
        // Validation rules
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'phone' => 'nullable|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'joining_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
        ]);

        // Create teacher
        $teacher = Teacher::create($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher created successfully!');
    }

    // Show single teacher details
    public function show(Teacher $teacher)
    {
        
        $teacher->load('courses');
        return view('teachers.show', compact('teacher'));
        return view('teachers.show', compact('teacher'));
    }

    // Show form to edit teacher
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    // Update teacher in database
    public function update(Request $request, Teacher $teacher)
    {
        // Validation rules
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone' => 'nullable|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'joining_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
        ]);

        // Update teacher
        $teacher->update($validated);

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully!');
    }

    // Delete teacher
    public function destroy(Teacher $teacher)
    {
        // Check if teacher has any courses
        if ($teacher->courses()->count() > 0) {
            return redirect()->route('teachers.index')
                ->with('error', 'Cannot delete! This teacher has ' . $teacher->courses()->count() . ' course(s). First delete or reassign courses.');
        }

        
    // simple teacher run kre not connect with course
    // public function destroy(Teacher $teacher)
    // {
    // $teacher->delete();

    // return redirect()->route('teachers.index')
    //     ->with('success', 'Teacher deleted successfully!');

        

        
        $teacher->delete();
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }
}
