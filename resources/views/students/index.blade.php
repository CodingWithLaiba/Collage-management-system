@extends('layouts.app')

@section('title', 'Students')
@section('page-title', 'Students Management')

@section('content')
<style>
    .students-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .students-header h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 24px;
        font-weight: 600;
    }
    
    .btn-add {
        background:#667eea;
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
    
    .students-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .students-table th {
        background:  #667eea;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .students-table td {
        padding: 15px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }
    
    .students-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .students-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.01);
    }
    
    .students-table tbody tr:last-child td {
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
    
    .student-id {
        font-weight: 600;
        color: #6366f1;
    }
    
    .student-name {
        font-weight: 500;
        color: #1e293b;
    }
    
    .student-email {
        color: #64748b;
        font-size: 14px;
    }
    
    .student-class {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #475569;
    }
</style>

<div class="students-header">
    <h3>📚 Students List</h3>
    <a href="{{ route('students.create') }}" class="btn-add">
        <span>+</span> Add Student
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
        ✓ {{ session('success') }}
    </div>
@endif

<table class="students-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td><span class="student-id">#{{ $student->id }}</span></td>
            <td><span class="student-name">{{ $student->name }}</span></td>
            <td><span class="student-email">{{ $student->email }}</span></td>
            <td><span class="student-class">{{ $student->class ?? 'N/A' }}</span></td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('students.show', $student->id) }}" class="btn-view">View</a>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($students->isEmpty())
    <div style="text-align: center; padding: 40px; color: #64748b;">
        <div style="font-size: 48px; margin-bottom: 10px;">📚</div>
        <p style="font-size: 18px; margin-bottom: 10px;">No students found</p>
        <p style="font-size: 14px;">Start by adding your first student!</p>
    </div>
@endif

@endsection
