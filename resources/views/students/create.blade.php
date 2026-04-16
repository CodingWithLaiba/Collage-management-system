@extends('layouts.app') 
 
@section('title', 'Add Student') 
@section('page-title', 'Add New Student') 
 
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
</style>

<div class="student-form">
    <div class="form-header">
        <h3>🎓 Add New Student</h3>
        <p>Fill in the information below to register a new student</p>
    </div>
    
    <form action="{{ route('students.store') }}" method="POST" id="studentForm">
        @csrf
        
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    Full Name <span class="required">*</span>
                </label>
                <div class="input-icon">
                    <input type="text" 
                           name="name" 
                           class="form-input icon-padding" 
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
                           placeholder="Enter father's full name">
                </div>
                <span class="error-message">Please enter father's name</span>
            </div>
            
            <div class="form-group full-width">
                <label class="form-label">
                    Home Address
                </label>
                <div class="input-icon address">
                    <textarea name="address" cols="50" rows="4"
                              class="form-textarea" 
                              placeholder="Enter complete home address including street, city, and postal code"></textarea>
                </div>
                <span class="error-message">Please enter a valid address</span>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <span>💾</span> Save Student
            </button>
            <a href="{{ route('students.index') }}" class="btn-cancel">
                <span>❌</span> Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.getElementById('studentForm').addEventListener('submit', function(e) {
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