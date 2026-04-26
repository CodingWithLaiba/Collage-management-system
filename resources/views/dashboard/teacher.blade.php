@extends('layouts.app')

@section('title', 'Teacher Dashboard')
@section('page-title', 'Welcome, ' . ($teacher->name ?? 'Teacher'))

@section('content')

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
    <div style="background: #3498db; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $courses->count() }}</h2>
        <p>My Courses</p>
    </div>
    <div style="background: #2ecc71; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $totalStudents }}</h2>
        <p>Total Students</p>
    </div>
    <div style="background: #f39c12; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $teacher->experience_years ?? 0 }}</h2>
        <p>Years Experience</p>
    </div>
</div>

<div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
    <h4>📚 My Courses</h4>
    
    @if($courses->count() > 0)
        <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse; margin-top: 15px;">
            <thead style="background: #ecf0f1;">
                <tr>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Credits</th>
                    <th>Enrolled Students</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->code }}</td>
                    <td style="text-align: center;">{{ $course->credits }}</td>
                    <td style="text-align: center;">{{ $course->students->count() }}</td>
                    <td style="text-align: center;">
                        @if($course->status == 'active')
                            <span style="background: #27ae60; color: white; padding: 2px 8px; border-radius: 12px;">Active</span>
                        @else
                            <span style="background: #e74c3c; color: white; padding: 2px 8px; border-radius: 12px;">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: gray; margin-top: 15px;">No courses assigned yet.</p>
    @endif
</div>

<div style="margin-top: 20px; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
    <h4>ℹ️ My Information</h4>
    <table style="margin-top: 15px;">
        <tr><td style="padding: 8px;"><strong>Name:</strong></td><td>{{ $teacher->name ?? '-' }}</td></tr>
        <tr><td style="padding: 8px;"><strong>Email:</strong></td><td>{{ $teacher->email ?? '-' }}</td></tr>
        <tr><td style="padding: 8px;"><strong>Qualification:</strong></td><td>{{ $teacher->qualification ?? '-' }}</td></tr>
        <tr><td style="padding: 8px;"><strong>Specialization:</strong></td><td>{{ $teacher->specialization ?? '-' }}</td></tr>
        <tr><td style="padding: 8px;"><strong>Phone:</strong></td><td>{{ $teacher->phone ?? '-' }}</td></tr>
    </table>
</div>

<div class="alert alert-info" style="background: #e3f2fd; padding: 15px; border-radius: 8px; margin-top: 20px;">
    <strong>ℹ️ Note:</strong> As a teacher, you can only VIEW data. For add/edit/delete operations, please contact the administrator.
</div>

@endsection
