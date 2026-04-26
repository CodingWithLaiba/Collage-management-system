@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
    <div style="background: #3498db; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $stats['students'] }}</h2>
        <p>Total Students</p>
    </div>
    <div style="background: #e74c3c; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $stats['teachers'] }}</h2>
        <p>Total Teachers</p>
    </div>
    <div style="background: #2ecc71; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $stats['courses'] }}</h2>
        <p>Total Courses</p>
    </div>
    <div style="background: #f39c12; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $stats['enrollments'] }}</h2>
        <p>Total Enrollments</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4>📊 Recent Students</h4>
        <table width="100%" cellpadding="8">
            @foreach($recentStudents as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->class ?? '-' }}</td>
            </tr>
            @endforeach
        </table>
        <a href="{{ route('students.index') }}">View All Students →</a>
    </div>
    
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4>📚 Recent Courses</h4>
        <table width="100%" cellpadding="8">
            @foreach($recentCourses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->code }}</td>
                <td>{{ $course->teacher->name ?? 'No Teacher' }}</td>
            </tr>
            @endforeach
        </table>
        <a href="{{ route('courses.index') }}">View All Courses →</a>
    </div>
</div>

<div style="margin-top: 20px;">
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4>⚡ Quick Actions</h4>
        <div style="display: flex; gap: 10px; margin-top: 15px;">
            <a href="{{ route('students.create') }}" style="background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none;">+ Add Student</a>
            <a href="{{ route('teachers.create') }}" style="background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none;">+ Add Teacher</a>
            <a href="{{ route('courses.create') }}" style="background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none;">+ Add Course</a>
        </div>
    </div>
</div>

@endsection
