<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\Teacher; 
use App\Models\TeacherProfile; 
use Illuminate\Http\Request; 
 
class TeacherController extends Controller
{ 
    // Show all teachers (READ) 
    public function index() 
    { 
        $teachers = Teacher::with('profile')->get(); 
        return view('teachers.index', compact('teachers')); 
    } 
 
    // Show form to create new Teacher 
    public function create() 
    { 
        return view('teachers.create'); 
    } 
 
    // Save new Teacher (CREATE) 
    public function store(Request $request) 
    { 
        $validated = $request->validate([ 
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:teachers', 
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
 
        // Create Teacher 
        $teacher = Teacher::create([ 
            'name' => $validated['name'], 
            'email' => $validated['email'], 
            'phone' => $validated['phone'] ?? null, 
            'class' => $validated['class'] ?? null, 
            'dob' => $validated['dob'] ?? null, 
            'gender' => $validated['gender'] ?? null, 
        ]); 
 
        // Create Profile 
        TeacherProfile::create([ 
            'teacher_id' => $teacher->id, 
            'address' => $validated['address'] ?? null, 
            'father_name' => $validated['father_name'] ?? null, 
            'mother_name' => $validated['mother_name'] ?? null, 
            'emergency_contact' => $validated['emergency_contact'] ?? null, 
            'blood_group' => $validated['blood_group'] ?? null, 
        ]); 
 
        return redirect()->route('teachers.index') 
            ->with('success', 'Teacher created successfully!'); 
    } 
 
    // Show single Teacher details 
    public function show(Teacher $teacher) 
    { 
        $teacher->load('profile'); 
        return view('teachers.show', compact('teacher')); 
    } 
 
    // Show edit form 
    public function edit(Teacher $teacher) 
    { 
        $teacher->load('profile'); 
        return view('teachers.edit', compact('teacher')); 
    } 
 
    // Update Teacher (UPDATE) 
    public function update(Request $request, Teacher $teacher) 
    { 
        $validated = $request->validate([ 
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:teachers,email,' . $teacher->id, 
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
 
        // Update Teacher 
        $teacher->update([ 
            'name' => $validated['name'], 
            'email' => $validated['email'], 
            'phone' => $validated['phone'] ?? null, 
            'class' => $validated['class'] ?? null, 
            'dob' => $validated['dob'] ?? null, 
            'gender' => $validated['gender'] ?? null, 
        ]); 
 
        // Update or Create Profile 
        if ($teacher->profile) { 
            $teacher->profile->update([ 
                'address' => $validated['address'] ?? null, 
                'father_name' => $validated['father_name'] ?? null, 
                'mother_name' => $validated['mother_name'] ?? null, 
                'emergency_contact' => $validated['emergency_contact'] ?? null, 
                'blood_group' => $validated['blood_group'] ?? null, 
            ]); 
        } else { 
            TeacherProfile::create([ 
                'Teacher_id' => $teacher->id, 
                'address' => $validated['address'] ?? null, 
                'father_name' => $validated['father_name'] ?? null, 
                'mother_name' => $validated['mother_name'] ?? null, 
                'emergency_contact' => $validated['emergency_contact'] ?? null, 
                'blood_group' => $validated['blood_group'] ?? null, 
            ]); 
        } 
 
        return redirect()->route('teachers.index') 
            ->with('success', 'Teacher updated successfully!'); 
    } 
 
    // Delete Teacher (DELETE) 
    public function destroy(Teacher $teacher) 
    { 
        $teacher->delete(); 
        return redirect()->route('teachers.index') 
            ->with('success', 'Teacher deleted successfully!'); 
    } 
}