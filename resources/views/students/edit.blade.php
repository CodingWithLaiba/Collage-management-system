@extends('layouts.app')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student: ' . $student->name)

@section('content')
<style>
    .student-form {
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
    
    .student-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .student-avatar {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .student-details h4 {
        margin: 0 0 5px 0;
        font-size: 18px;
    }
    
    .student-details p {
        margin: 0;
        font-size: 14px;
        opacity: 0.9;
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
    .form-textarea {
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f9fafb;
    }
    
    .form-input:focus,
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
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
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
        content: '👤';
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
    }
    
    .input-icon.email::before {
        content: '📧';
    }
    
    .input-icon.phone::before {
        content: '📱';
    }
    
    .input-icon.class::before {
        content: '📚';
    }
    
    .input-icon.father::before {
        content: '👨‍👦';
    }
    
    .input-icon.address::before {
        content: '📍';
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
    .form-group.error .form-textarea {
        border-color: #ef4444;
    }
    
    .form-group.error .error-message {
        display: block;
    }
    
    .last-updated {
        text-align: center;
        color: #64748b;
        font-size: 14px;
        margin-top: 15px;
        font-style: italic;
    }
</style>

<div class="student-form">
    <div class="form-header">
        <h3>✏️ Edit Student Information</h3>
        <p>Update the student's details below</p>
    </div>
    
    <div class="student-info">
        <div class="student-avatar">👤</div>
        <div class="student-details">
            <h4>{{ $student->name }}</h4>
            <p>{{ $student->email }} • ID: #{{ $student->id }}</p>
        </div>
    </div>
    
    <form action="{{ route('students.update', $student->id) }}" method="POST" id="editForm">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    Full Name <span class="required">*</span>
                </label>
                <div class="input-icon">
                    <input type="text" 
                           name="name" 
                           class="form-input icon-padding" 
                           value="{{ $student->name }}" 
                           required 
                           placeholder="Enter student's full name">
                </div>
                <span class="error-message">Please enter a valid name</span>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Email Address <span class="required">*</span>
                </label>
                <div class="input-icon email">
                    <input type="email" 
                           name="email" 
                           class="form-input icon-padding" 
                           value="{{ $student->email }}" 
                           required 
                           placeholder="student@example.com">
                </div>
                <span class="error-message">Please enter a valid email address</span>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Phone Number
                </label>
                <div class="input-icon phone">
                    <input type="tel" 
                           name="phone" 
                           class="form-input icon-padding" 
                           value="{{ $student->phone }}" 
                           placeholder="+1 (555) 123-4567">
                </div>
                <span class="error-message">Please enter a valid phone number</span>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Class/Grade
                </label>
                <div class="input-icon class">
                    <input type="text" 
                           name="class" 
                           class="form-input icon-padding" 
                           value="{{ $student->class }}" 
                           placeholder="e.g., Grade 10, Section A">
                </div>
                <span class="error-message">Please enter a valid class</span>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Father's Name
                </label>
                <div class="input-icon father">
                    <input type="text" 
                           name="father_name" 
                           class="form-input icon-padding" 
                           value="{{ $student->profile->father_name ?? '' }}" 
                           placeholder="Enter father's full name">
                </div>
                <span class="error-message">Please enter father's name</span>
            </div>
            
            <div class="form-group full-width">
                <label class="form-label">
                    Home Address
                </label>
                <div class="input-icon address">
                    <textarea name="address" 
                              class="form-textarea" 
                              placeholder="Enter complete home address including street, city, and postal code">{{ $student->profile->address ?? '' }}</textarea>
                </div>
                <span class="error-message">Please enter a valid address</span>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <span>💾</span> Update Student
            </button>
            <a href="{{ route('students.index') }}" class="btn-cancel">
                <span>❌</span> Cancel
            </a>
        </div>
    </form>
    
    <div class="last-updated">
        Last updated: {{ $student->updated_at->format('F j, Y \a\t g:i A') }}
    </div>
</div>

<script>
document.getElementById('editForm').addEventListener('submit', function(e) {
    const form = e.target;
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        const formGroup = field.closest('.form-group');
        if (!field.value.trim()) {
            formGroup.classList.add('error');
            isValid = false;
        } else {
            formGroup.classList.remove('error');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
    }
});

// Remove error styling on input
document.querySelectorAll('.form-input, .form-textarea').forEach(field => {
    field.addEventListener('input', function() {
        const formGroup = this.closest('.form-group');
        if (this.value.trim()) {
            formGroup.classList.remove('error');
        }
    });
});
</script>

@endsection