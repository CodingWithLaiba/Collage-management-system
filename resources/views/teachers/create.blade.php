@extends('layouts.app')

@section('title', 'Add Teacher')
@section('page-title', 'Add New Teacher')

@section('content')
<style>
    .teacher-form {
        max-width: 900px;
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
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 25px;
        margin-bottom: 20px;
    }
    
    .form-section {
        background: #f8fafc;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }
    
    .section-title {
        color: #334155;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
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
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f9fafb;
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
        min-height: 100px;
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
    
    .error-message {
        color: #ef4444;
        font-size: 14px;
        margin-top: 5px;
    }
    
    .form-group.error .form-input,
    .form-group.error .form-select,
    .form-group.error .form-textarea {
        border-color: #ef4444;
    }
</style>

<div class="teacher-form">
    <div class="form-header">
        <h3> Add New Teacher</h3>
        <p>Fill in the information below to register a new teacher</p>
    </div>
    
    <form action="{{ route('teachers.store') }}" method="POST" id="teacherForm">
        @csrf
        
        <div class="form-grid">
            <div class="form-section">
                <h4 class="section-title">
                    <span>👤</span> Basic Information
                </h4>
                
                <div class="form-group">
                    <label class="form-label">
                        Full Name <span class="required">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           class="form-input" 
                           value="{{ old('name') }}" 
                           required 
                           placeholder="Enter teacher's full name">
                    @error('name') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Email Address <span class="required">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           class="form-input" 
                           value="{{ old('email') }}" 
                           required 
                           placeholder="teacher@example.com">
                    @error('email') <span class="error-message">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Phone Number
                    </label>
                    <input type="tel" 
                           name="phone" 
                           class="form-input" 
                           value="{{ old('phone') }}" 
                           placeholder="+1 (555) 123-4567">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Gender
                    </label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Joining Date
                    </label>
                    <input type="date" 
                           name="joining_date" 
                           class="form-input" 
                           value="{{ old('joining_date') }}">
                </div>
            </div>

            <div class="form-section">
                <h4 class="section-title">
                    <span>🎓</span> Professional Information
                </h4>

                <div class="form-group">
                    <label class="form-label">
                        Qualification
                    </label>
                    <input type="text" 
                           name="qualification" 
                           class="form-input" 
                           value="{{ old('qualification') }}"
                           placeholder="e.g., MSc, BEd, PhD">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Specialization
                    </label>
                    <input type="text" 
                           name="specialization" 
                           class="form-input" 
                           value="{{ old('specialization') }}"
                           placeholder="e.g., Mathematics, Physics, Computer Science">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Experience (Years)
                    </label>
                    <input type="number" 
                           name="experience_years" 
                           class="form-input" 
                           value="{{ old('experience_years', 0) }}"
                           placeholder="0">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Home Address
                    </label>
                    <textarea name="address" 
                              class="form-textarea" 
                              placeholder="Enter complete home address including street, city, and postal code">{{ old('address') }}</textarea>
                </div>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <span>💾</span> Save Teacher
            </button>
            <a href="{{ route('teachers.index') }}" class="btn-cancel">
                <span>❌</span> Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.getElementById('teacherForm').addEventListener('submit', function(e) {
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
document.querySelectorAll('.form-input, .form-select, .form-textarea').forEach(field => {
    field.addEventListener('input', function() {
        const formGroup = this.closest('.form-group');
        if (this.value.trim()) {
            formGroup.classList.remove('error');
        }
    });
});
</script>

@endsection
