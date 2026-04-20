<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\Course; 
use App\Models\Teacher; 
use App\Models\Student; 
use Illuminate\Http\Request; 
 
class CourseController extends Controller 
{ 
    // Display list of all courses 
    public function index() 
    { 
        $courses = Course::with('teacher')->get(); 
        return view('courses.index', compact('courses')); 
    } 
 
    // Show form to create new course 
    public function create() 
    { 
        $teachers = Teacher::all(); 
        $students = Student::all(); 
        return view('courses.create', compact('teachers', 'students')); 
    } 
 
    // Store new course in database 
    public function store(Request $request) 
    { 
        // Validation rules 
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
 
        // Attach students if selected (Many-to-Many) 
        if ($request->has('student_ids')) { 
            $course->students()->attach($request->student_ids, [ 
                'enrollment_date' => now(), 
                'status' => 'enrolled' 
            ]); 
        } 
 
        return redirect()->route('courses.index') 
            ->with('success', 'Course created successfully!'); 
    } 
 
    // Show single course details 
    public function show(Course $course) 
    { 
        $course->load('teacher', 'students'); 
        return view('courses.show', compact('course')); 
    } 
 
    // Show form to edit course 
   public function edit(Course $course)  // $course is automatically the Course with ID=5
{
    // Get all teachers from database for dropdown
    $teachers = Teacher::all();
    
    // Get all students from database for multi-select
    $students = Student::all();
    
    // Get IDs of students already enrolled in this course
    $enrolledStudentIds = $course->students->pluck('id')->toArray();
    // Example: [1, 3, 5] means students with ID 1,3,5 are enrolled
    
    // Pass data to the edit view
    return view('courses.edit', compact('course', 'teachers', 'students', 'enrolledStudentIds'));
}
 
    // Update course in database 
    public function update(Request $request, Course $course) 
    { 
        // Validation rules 
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
 
        // Sync students (Many-to-Many) - this will add/remove as needed 
        $course->students()->sync($request->student_ids ?? []); 
 
        return redirect()->route('courses.index') 
            ->with('success', 'Course updated successfully!'); 
    } 
 
    // Delete course 
    public function destroy(Course $course) 
    { 
        // Check if course has enrolled students 
        if ($course->students()->count() > 0) { 
            return redirect()->route('courses.index') 
                ->with('error', 'Cannot delete! This course has ' . $course->students()->count() . ' 
enrolled student(s). First remove all students.'); 
        } 
         
        $course->delete(); 
        return redirect()->route('courses.index') 
            ->with('success', 'Course deleted successfully!'); 
    } 
     
    // Additional method: Show enrollment form for a course 
    public function enrollmentForm(Course $course) 
    { 
        $students = Student::all(); 
        $enrolledStudentIds = $course->students->pluck('id')->toArray(); 
         
        return view('courses.enrollment', compact('course', 'students', 'enrolledStudentIds')); 
    } 
     
    // Update enrollment (add/remove students) 
    public function updateEnrollment(Request $request, Course $course) 
    { 
        $request->validate([ 
            'student_ids' => 'nullable|array', 
            'student_ids.*' => 'exists:students,id', 
        ]); 
         
        $course->students()->sync($request->student_ids ?? []); 
         
        return redirect()->route('courses.show', $course->id) 
            ->with('success', 'Enrollment updated successfully!'); 
    } 
}