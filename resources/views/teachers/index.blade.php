@extends('layouts.app')

@section('title', 'Teachers')
@section('page-title', 'Teachers Management')

@section('content')
<style>
    .teachers-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .teachers-header h3 {
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

    .teachers-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .teachers-table th {
        background: #667eea;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .teachers-table td {
        padding: 15px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }

    .teachers-table tbody tr {
        transition: all 0.2s ease;
    }

    .teachers-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.01);
    }

    .teachers-table tbody tr:last-child td {
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

    .teacher-id {
        font-weight: 600;
        color: #6366f1;
    }

    .teacher-name {
        font-weight: 500;
        color: #1e293b;
    }

    .teacher-email {
        color: #64748b;
        font-size: 14px;
    }

    .teacher-qualification {
        background: #dbeafe;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #1e40af;
    }

    .teacher-specialization {
        background: #fef3c7;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #92400e;
    }

    .teacher-experience {
        background: #d1fae5;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        color: #065f46;
    }

    .courses-count {
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
</style>

<div class="teachers-header">
    <h3> Teachers List</h3>
    <a href="{{ route('teachers.create') }}" class="btn-add">
        <span>+</span> Add Teacher
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

<table class="teachers-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Qualification</th>
            <th>Specialization</th>
            <th>Experience</th>
            <th>Courses</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($teachers as $teacher)
        <tr>
            <td><span class="teacher-id">#{{ $teacher->id }}</span></td>
            <td><span class="teacher-name">{{ $teacher->name }}</span></td>
            <td><span class="teacher-email">{{ $teacher->email }}</span></td>
            <td><span class="teacher-qualification">{{ $teacher->qualification ?? 'N/A' }}</span></td>
            <td><span class="teacher-specialization">{{ $teacher->specialization ?? 'N/A' }}</span></td>
            <td><span class="teacher-experience">{{ $teacher->experience_years }} years</span></td>
            <td style="text-align: center;">
                <span style="background: #3498db; color: white; padding: 2px 8px; border-radius:12px;">
                    {{ $teacher->courses->count() }}
                </span>
            </td>
            <td class="action-buttons">
                <a href="{{ route('teachers.show', $teacher->id) }}" class="btn-view">View</a>
                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn-edit">Edit</a>
                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</button>
                </form>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                <div style="font-size: 48px; margin-bottom: 10px;"> </div>
                <p style="font-size: 18px; margin-bottom: 10px;">No teachers found</p>
                <p style="font-size: 14px;">Start by adding your first teacher!</p>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection