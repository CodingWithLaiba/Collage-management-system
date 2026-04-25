<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     * ✅ Admin & Teacher both can view
     */
    public function index()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $courses = Course::with('teacher')->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show form for creating new course.
     * ✅ Admin only
     */
    public function create()
    {
        // Only admin can create
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can add courses.');
        }
        
        $teachers = Teacher::all();
        $students = Student::all();
        return view('courses.create', compact('teachers', 'students'));
    }

    /**
     * Store a newly created course.
     * ✅ Admin only
     */
    public function store(Request $request)
    {
        // Only admin can store
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can add courses.');
        }
        
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:courses',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:6',
            'duration_hours' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
            'teacher_id' => 'nullable|exists:teachers,id',
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        // Create course
        $course = Course::create($validated);

        // Attach students if selected
        if ($request->has('student_ids') && !empty($request->student_ids)) {
            $course->students()->attach($request->student_ids, [
                'enrollment_date' => now(),
                'status' => 'enrolled'
            ]);
        }

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully!');
    }

    /**
     * Display specified course.
     * ✅ Admin & Teacher both can view
     */
    public function show(Course $course)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $course->load('teacher', 'students');
        return view('courses.show', compact('course'));
    }

    /**
     * Show form for editing course.
     * ✅ Admin only
     */
    public function edit(Course $course)
    {
        // Only admin can edit
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can edit courses.');
        }
        
        $teachers = Teacher::all();
        $students = Student::all();
        $enrolledStudentIds = $course->students->pluck('id')->toArray();
        
        return view('courses.edit', compact('course', 'teachers', 'students', 'enrolledStudentIds'));
    }

    /**
     * Update specified course.
     * ✅ Admin only
     */
    public function update(Request $request, Course $course)
    {
        // Only admin can update
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can update courses.');
        }
        
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:courses,code,' . $course->id,
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:6',
            'duration_hours' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
            'teacher_id' => 'nullable|exists:teachers,id',
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        // Update course
        $course->update($validated);

        // Sync students (Many-to-Many)
        $course->students()->sync($request->student_ids ?? []);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Delete specified course.
     * ✅ Admin only
     */
    public function destroy(Course $course)
    {
        // Only admin can delete
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Only admin can delete courses.');
        }
        
        // Check if course has enrolled students
        if ($course->students()->count() > 0) {
            return redirect()->route('courses.index')
                ->with('error', 'Cannot delete! This course has ' . $course->students()->count() . ' enrolled student(s). First remove all students.');
        }
        
        $course->delete();
        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully!');
    }
}