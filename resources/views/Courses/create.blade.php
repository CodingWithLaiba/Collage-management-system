@extends('layouts.app')

@section('title', 'Add Course')
@section('page-title', 'Add New Course')

@section('content')
<style>
    .course-form {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .form-header h3 {
        color: #2c3e50;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .form-header p {
        color: #64748b;
        font-size: 16px;
        margin: 0;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-label .required {
        color: #ef4444;
        margin-left: 4px;
    }
    
    .form-input,
    .form-select,
    .form-textarea {
        padding: 12px 25px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f9fafb;
        width: 100%;
        box-sizing: border-box;
    }
    
    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .form-textarea {
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
    }
    
    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }
    
    .btn-cancel {
        background: #f3f4f6;
        color: #6b7280;
        padding: 12px 30px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-cancel:hover {
        background: #e5e7eb;
        color: #374151;
        text-decoration: none;
        transform: translateY(-2px);
    }
    
    .input-icon {
        position: relative;
    }
    
    .input-icon::before {
        content: '📚';
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
    }
    
    .input-icon.code::before {
        content: '🏷️';
    }
    
    .input-icon.credits::before {
        content: '⭐';
    }
    
    .input-icon.duration::before {
        content: '⏰';
    }
    
    .input-icon.status::before {
        content: '📊';
    }
    
    .input-icon.teacher::before {
        content: '👨‍🏫';
    }
    
    .input-icon.students::before {
        content: '👥';
    }
    
    .form-input.icon-padding {
        padding-left: 45px;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 14px;
        margin-top: 5px;
        display: none;
    }
    
    .form-group.error .form-input,
    .form-group.error .form-select,
    .form-group.error .form-textarea {
        border-color: #ef4444;
    }
    
    .form-group.error .error-message {
        display: block;
    }
</style>

<div class="course-form">
    <div class="form-header">
        <h3>📚 Add New Course</h3>
        <p>Fill in the information below to create a new course</p>
    </div>
    
    <form action="{{ route('courses.store') }}" method="POST" id="courseForm">
        @csrf
        
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    Course Name <span class="required">*</span>
                </label>
                <div class="input-icon">
                    <input type="text" 
                           name="name" 
                           class="form-input icon-padding" 
                           required 
                           value="{{ old('name') }}"
                           placeholder="e.g., Web Development, Mathematics">
                </div>
                <span class="error-message">Please enter a valid course name</span>
                @error('name') <span style="color: #ef4444; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Course Code <span class="required">*</span>
                </label>
                <div class="input-icon code">
                    <input type="text" 
                           name="code" 
                           class="form-input icon-padding" 
                           required 
                           value="{{ old('code') }}"
                           placeholder="e.g., CS101, MATH201">
                </div>
                <span class="error-message">Please enter a valid course code</span>
                @error('code') <span style="color: #ef4444; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Credits <span class="required">*</span>
                </label>
                <div class="input-icon credits">
                    <select name="credits" class="form-select icon-padding" required>
                        <option value="">Select Credits</option>
                        <option value="1" {{ old('credits') == 1 ? 'selected' : '' }}>1 Credit</option>
                        <option value="2" {{ old('credits') == 2 ? 'selected' : '' }}>2 Credits</option>
                        <option value="3" {{ old('credits') == 3 ? 'selected' : '' }}>3 Credits</option>
                        <option value="4" {{ old('credits') == 4 ? 'selected' : '' }}>4 Credits</option>
                        <option value="5" {{ old('credits') == 5 ? 'selected' : '' }}>5 Credits</option>
                        <option value="6" {{ old('credits') == 6 ? 'selected' : '' }}>6 Credits</option>
                    </select>
                </div>
                @error('credits') <span style="color: #ef4444; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Duration (Hours)
                </label>
                <div class="input-icon duration">
                    <input type="number" 
                           name="duration_hours" 
                           class="form-input icon-padding" 
                           value="{{ old('duration_hours', 40) }}"
                           placeholder="40">
                </div>
                <span class="error-message">Please enter a valid duration</span>
                @error('duration_hours') <span style="color: #ef4444; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Course Status
                </label>
                <div class="input-icon status">
                    <select name="status" class="form-select icon-padding">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                @error('status') <span style="color: #ef4444; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Assign Teacher
                </label>
                <div class="input-icon teacher">
                    <select name="teacher_id" class="form-select icon-padding">
                        <option value="">-- Select Teacher --</option>
                        @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }} ({{ $teacher->specialization ?? 'General' }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <small style="color: #64748b; font-size: 12px; margin-top: 5px; display: block;">Optional: Select teacher who will teach this course</small>
                @error('teacher_id') <span style="color: #ef4444; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group full-width">
                <label class="form-label">
                    Enroll Students
                </label>
                <select name="student_ids[]" multiple class="form-select" style="min-height: 150px;">
                    @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ in_array($student->id, old('student_ids', [])) ? 'selected' : '' }}>
                        {{ $student->name }} ({{ $student->class ?? 'No Class' }})
                    </option>
                    @endforeach
                </select>
                <small style="color: #64748b; font-size: 12px; margin-top: 5px; display: block;">Hold Ctrl (Windows) or Cmd (Mac) to select multiple students</small>
                @error('student_ids') <span style="color: #ef4444; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group full-width">
                <label class="form-label">
                    Course Description
                </label>
                <div class="input-icon description">
                    <textarea name="description" 
                              class="form-textarea" 
                              rows="6"
                              placeholder="Course description, syllabus, prerequisites...">{{ old('description') }}</textarea>
                </div>
                <span class="error-message">Please enter a course description</span>
                @error('description') <span style="color: #ef4444; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <span>💾</span> Create Course
            </button>
            <a href="{{ route('courses.index') }}" class="btn-cancel">
                <span>❌</span> Cancel
            </a>
        </div>
    </form>
</div>

@endsection