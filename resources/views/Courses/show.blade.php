@extends('layouts.app')

@section('title', 'Course Details')
@section('page-title', 'Course Details: ' . $course->name)

@section('content')
<style>
    .course-show {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .show-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
        position: relative;
    }
    
    .show-header h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .show-header p {
        margin: 10px 0 0;
        opacity: 0.9;
        font-size: 16px;
    }
    
    .show-content {
        padding: 30px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .info-card {
        background: #f8fafc;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .card-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }
    
    .card-title {
        font-size: 20px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }
    
    .info-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .info-table tr {
        border-bottom: 1px solid #e5e7eb;
    }
    
    .info-table tr:last-child {
        border-bottom: none;
    }
    
    .info-table td {
        padding: 12px 0;
        color: #475569;
    }
    
    .info-table td:first-child {
        font-weight: 600;
        color: #374151;
        width: 140px;
    }
    
    .badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-active {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .badge-inactive {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .students-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .students-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .students-table th {
        padding: 15px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .students-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .students-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.01);
    }
    
    .students-table td {
        padding: 15px 12px;
        color: #475569;
    }
    
    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-enrolled {
        background: #10b981;
        color: white;
    }
    
    .status-completed {
        background: #3b82f6;
        color: white;
    }
    
    .status-dropped {
        background: #ef4444;
        color: white;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        text-decoration: none;
        color: white;
    }
    
    .btn-back {
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
    
    .btn-back:hover {
        background: #e5e7eb;
        color: #374151;
        text-decoration: none;
        transform: translateY(-2px);
    }
    
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #64748b;
    }
    
    .empty-state h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #374151;
    }
    
    .total-count {
        background: linear-gradient(135deg, #f3e8ff 0%, #e0e7ff 100%);
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        color: #6b21a8;
        margin-top: 15px;
        display: inline-block;
    }
</style>

<div class="course-show">
    <div class="show-header">
        <h2>📚 {{ $course->name }}</h2>
        <p>Course details and enrolled students information</p>
    </div>
    
    <div class="show-content">
        <div class="info-grid">
            <!-- Course Information Card -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">📝</div>
                    <h3 class="card-title">Course Information</h3>
                </div>
                <table class="info-table">
                    <tr>
                        <td>Course ID</td>
                        <td>{{ $course->id }}</td>
                    </tr>
                    <tr>
                        <td>Course Code</td>
                        <td><strong>{{ $course->code }}</strong></td>
                    </tr>
                    <tr>
                        <td>Credits</td>
                        <td>{{ $course->credits }}</td>
                    </tr>
                    <tr>
                        <td>Duration</td>
                        <td>{{ $course->duration_hours ?? 'N/A' }} hours</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            @if($course->status == 'active')
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $course->description ?? 'No description provided' }}</td>
                    </tr>
                </table>
            </div>
            
            <!-- Teacher Information Card -->
            <div class="info-card">
                <div class="card-header">
                    <div class="card-icon">👨‍🏫</div>
                    <h3 class="card-title">Teacher Information</h3>
                </div>
                @if($course->teacher)
                <table class="info-table">
                    <tr>
                        <td>Teacher Name</td>
                        <td>{{ $course->teacher->name }}</td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td>{{ $course->teacher->qualification ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Specialization</td>
                        <td>{{ $course->teacher->specialization ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Experience</td>
                        <td>{{ $course->teacher->experience_years ?? 'N/A' }} years</td>
                    </tr>
                </table>
                @else
                <div class="empty-state">
                    <h3>No Teacher Assigned</h3>
                    <p>This course doesn't have a teacher assigned yet.</p>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Enrolled Students Section -->
        <div class="info-card" style="grid-column: 1 / -1;">
            <div class="card-header">
                <div class="card-icon">👥</div>
                <h3 class="card-title">Enrolled Students</h3>
            </div>
            
            @if($course->students && $course->students->count() > 0)
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Class</th>
                            <th>Enrollment Date</th>
                            <th>Status</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->class ?? '-' }}</td>
                            <td>{{ $student->pivot->enrollment_date ?? '-' }}</td>
                            <td>
                                @if($student->pivot->status == 'enrolled')
                                    <span class="status-badge status-enrolled">Enrolled</span>
                                @elseif($student->pivot->status == 'completed')
                                    <span class="status-badge status-completed">Completed</span>
                                @else
                                    <span class="status-badge status-dropped">Dropped</span>
                                @endif
                            </td>
                            <td>{{ $student->pivot->grade ?? 'Not graded' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="total-count">
                    📊 Total Enrolled: {{ $course->students->count() }} students
                </div>
            @else
                <div class="empty-state">
                    <h3>No Students Enrolled</h3>
                    <p>This course doesn't have any enrolled students yet.</p>
                </div>
            @endif
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('courses.edit', $course->id) }}" class="btn-edit">
                <span>✏️</span> Edit Course
            </a>
            <a href="{{ route('courses.index') }}" class="btn-back">
                <span>🔙</span> Back to Courses
            </a>
        </div>
    </div>
</div>

@endsection