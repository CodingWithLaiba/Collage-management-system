@extends('layouts.app')
@section('title', 'Courses')
@section('page-title', 'Courses Management')
@section('content')
<style>
    .courses-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .courses-header h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 24px;
        font-weight: 600;
    }
    
    .btn-add {
        background: #667eea;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        text-decoration: none;
        color: white;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        color: #0a5f3e;
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        border-left: 4px solid #10b981;
        font-weight: 500;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #fca5a5 0%, #fbbf24 100%);
        color: #991b1b;
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        border-left: 4px solid #ef4444;
        font-weight: 500;
    }
    
    .courses-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .courses-table th {
        background: #667eea;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .courses-table td {
        padding: 15px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }
    
    .courses-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .courses-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.01);
    }
    
    .courses-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .btn-view {
        background: #3b82f6;
        color: white;
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-view:hover {
        background: #2563eb;
        transform: translateY(-1px);
        text-decoration: none;
        color: white;
    }
    
    .btn-edit {
        background: #f59e0b;
        color: white;
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-edit:hover {
        background: #d97706;
        transform: translateY(-1px);
        text-decoration: none;
        color: white;
    }
    
    .btn-delete {
        background: #ef4444;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }
    
    .course-id {
        font-weight: 600;
        color: #6366f1;
    }
    
    .course-name {
        font-weight: 500;
        color: #1e293b;
    }
    
    .course-code {
        background: #dbeafe;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #1e40af;
    }
    
    .course-credits {
        background: #fef3c7;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #92400e;
        text-align: center;
        display: inline-block;
        min-width: 40px;
    }
    
    .teacher-name {
        font-weight: 500;
        color: #059669;
    }
    
    .teacher-unassigned {
        color: #94a3b8;
        font-style: italic;
    }
    
    .students-count {
        background: #f3e8ff;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #6b21a8;
        text-align: center;
        display: inline-block;
        min-width: 60px;
    }
    
    .status-active {
        background: #d1fae5;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #065f46;
        text-align: center;
        display: inline-block;
        min-width: 60px;
    }
    
    .status-inactive {
        background: #fee2e2;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #991b1b;
        text-align: center;
        display: inline-block;
        min-width: 60px;
    }
</style>

<div class="courses-header">
    <h3> Courses List</h3>
    <a href="{{ route('courses.create') }}" class="btn-add">
        <span>+</span> Add Course
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
         {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-error">
         {{ session('error') }}
    </div>
@endif

<table class="courses-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Code</th>
            <th>Credits</th>
            <th>Teacher</th>
            <th>Students</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($courses as $course)
        <tr>
            <td><span class="course-id">#{{ $course->id }}</span></td>
            <td><span class="course-name">{{ $course->name }}</span></td>
            <td><span class="course-code">{{ $course->code }}</span></td>
            <td><span class="course-credits">{{ $course->credits }}</span></td>
            <td>
                @if($course->teacher)
                    <span class="teacher-name">{{ $course->teacher->name }}</span>
                @else
                    <span class="teacher-unassigned">Not Assigned</span>
                @endif
            </td>
            <td><span class="students-count">{{ $course->students->count() }}</span></td>
            <td>
                @if($course->status == 'active')
                    <span class="status-active">Active</span>
                @else
                    <span class="status-inactive">Inactive</span>
                @endif
            </td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('courses.show', $course->id) }}" class="btn-view">View</a>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                <div style="font-size: 48px; margin-bottom: 10px;"> </div>
                <p style="font-size: 18px; margin-bottom: 10px;">No courses found</p>
                <p style="font-size: 14px;">Start by adding your first course!</p>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection