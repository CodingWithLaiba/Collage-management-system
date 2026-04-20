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
    //  Validate the incoming form data
    $validated = $request->validate([
        'name' => 'required|string|max:255',      // Name is required
        'code' => 'required|string|max:50|unique:courses,code,' . $course->id,
        // ↑ IMPORTANT: unique EXCEPT current course's own code
        // Without this, updating would fail because code already exists
        
        'description' => 'nullable|string',       // Optional field
        'credits' => 'required|integer|min:1|max:6',
        'duration_hours' => 'nullable|integer|min:1',
        'status' => 'required|in:active,inactive',
        'teacher_id' => 'nullable|exists:teachers,id',
        'student_ids' => 'nullable|array',
        'student_ids.*' => 'exists:students,id',  // Each student ID must exist
    ]);

    //  Update the course basic information
    $course->update($validated);
    // This updates: name, code, description, credits, duration_hours, status, teacher_id
    
    //  Sync students (Many-to-Many relationship)
    $course->students()->sync($request->student_ids ?? []);
    // sync() does THREE things automatically:
    // - Adds new students that weren't enrolled before
    // - Removes students that were unselected
    // - Keeps existing ones that remain selected
    // 
    // Example: Before sync: enrolled [1,2,3]
    //          After sync with [1,3,5]: 
    //          - Student 2 is removed
    //          - Student 5 is added
    //          - Students 1 and 3 remain

    // Line 4: Redirect back to courses list with success message
    return redirect()->route('courses.index')
        ->with('success', 'Course updated successfully!');
}
 
    // Delete course 
    public function destroy(Course $course)
{
    // Check if course has enrolled students
    if ($course->students()->count() > 0) {
        // If yes, don't delete - show error message
        return redirect()->route('courses.index')
            ->with('error', 'Cannot delete! This course has ' . 
                   $course->students()->count() . ' enrolled student(s). First remove all students.');
    }
    
    // If no students, delete the course
    $course->delete();
    
    // Redirect with success message
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