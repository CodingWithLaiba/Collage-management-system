<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of teachers.
     * ✅ Admin & Teacher both can view
     */
    public function index()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $teachers = Teacher::with('courses')->get();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show form for creating new teacher.
     * ✅ Admin only
     */
    public function create()
    {
        // Only admin can create
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can add teachers.');
        }
        
        return view('teachers.create');
    }

    /**
     * Store a newly created teacher.
     * ✅ Admin only
     */
    public function store(Request $request)
    {
        // Only admin can store
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can add teachers.');
        }
        
        // Validation
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

    /**
     * Display specified teacher.
     * ✅ Admin & Teacher both can view
     */
    public function show(Teacher $teacher)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $teacher->load('courses');
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show form for editing teacher.
     * ✅ Admin only
     */
    public function edit(Teacher $teacher)
    {
        // Only admin can edit
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can edit teachers.');
        }
        
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update specified teacher.
     * ✅ Admin only
     */
    public function update(Request $request, Teacher $teacher)
    {
        // Only admin can update
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can update teachers.');
        }
        
        // Validation
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

    /**
     * Delete specified teacher.
     * ✅ Admin only
     */
    public function destroy(Teacher $teacher)
    {
        // Only admin can delete
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can delete teachers.');
        }
        
        // Check if teacher has any courses
        if ($teacher->courses()->count() > 0) {
            return redirect()->route('teachers.index')
                ->with('error', 'Cannot delete! This teacher has ' . $teacher->courses()->count() . ' course(s). First delete or reassign courses.');
        }
        
        $teacher->delete();
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }
}
