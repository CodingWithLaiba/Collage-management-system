@extends('layouts.app')

@section('title', 'Edit Course')
@section('page-title', 'Edit Course: ' . $course->name)

@section('content')

<form action="{{ route('courses.update', $course->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

        <!-- Left Column -->
        <div>
            <h4 style="margin-bottom: 15px;">Course Information</h4>

            <div style="margin-bottom: 15px;">
                <label>Course Name *</label>
                <input type="text" name="name" value="{{ old('name', $course->name) }}" required
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                @error('name') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Course Code *</label>
                <input type="text" name="code" value="{{ old('code', $course->code) }}" required
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                @error('code') <span style="color: red;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Credits *</label>
                <select name="credits" required style="width: 100%; padding: 8px; border: 1px solid 
#ddd; border-radius: 4px;">
                    <option value="1" {{ old('credits', $course->credits) == 1 ? 'selected' : '' }}>1
                        Credit</option>
                    <option value="2" {{ old('credits', $course->credits) == 2 ? 'selected' : '' }}>2
                        Credits</option>
                    <option value="3" {{ old('credits', $course->credits) == 3 ? 'selected' : '' }}>3
                        Credits</option>
                    <option value="4" {{ old('credits', $course->credits) == 4 ? 'selected' : '' }}>4
                        Credits</option>
                    <option value="5" {{ old('credits', $course->credits) == 5 ? 'selected' : '' }}>5
                        Credits</option>
                    <option value="6" {{ old('credits', $course->credits) == 6 ? 'selected' : '' }}>6
                        Credits</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Duration (Hours)</label>
                <input type="number" name="duration_hours" value="{{ old('duration_hours', 
$course->duration_hours) }}"
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Status</label>
                <select name="status" style="width: 100%; padding: 8px; border: 1px solid #ddd; 
border-radius: 4px;">
                    <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' 
}}>Active</option>
                    <option value="inactive" {{ old('status', $course->status) == 'inactive' ? 'selected' : '' 
}}>Inactive</option>
                </select>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <h4 style="margin-bottom: 15px;">Teacher & Students</h4>

            <div style="margin-bottom: 15px;">
                <label>Assign Teacher</label>
                <select name="teacher_id" style="width: 100%; padding: 8px; border: 1px solid #ddd; 
border-radius: 4px;">
                    <option value="">-- Select Teacher --</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }} ({{ $teacher->specialization ?? 'General' }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Enrolled Students</label>
                <select name="student_ids[]" multiple
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-height: 150px;">
                    @foreach($students as $student)
                    <option value="{{ $student->id }}"
                        {{ in_array($student->id, old('student_ids', $enrolledStudentIds)) ? 'selected' : 
'' }}>
                        {{ $student->name }} ({{ $student->class ?? 'No Class' }})
                    </option>
                    @endforeach
                </select>
                <small style="color: gray;">Hold Ctrl (Windows) or Cmd (Mac) to select/deselect
                    students</small>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Description</label>
                <textarea name="description" rows="6"
                    style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{
old('description', $course->description) }}</textarea>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px; text-align: center;">
        <button type="submit"
            style="background: #f39c12; color: white; padding: 10px 30px; border: none; border-radius: 5px; cursor: pointer;">
            Update Course
        </button>
        <a href="{{ route('courses.index') }}"
            style="background: #95a5a6; color: white; padding: 10px 30px; text-decoration: none; 
border-radius: 5px; margin-left: 10px;">
            Cancel
        </a>
    </div>
</form>

@endsection