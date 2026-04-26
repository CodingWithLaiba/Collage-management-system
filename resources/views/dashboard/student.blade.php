@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('page-title', 'Welcome, ' . ($student->name ?? 'Student'))

@section('content')

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
    <div style="background: #3498db; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $enrolledCourses->count() }}</h2>
        <p>Enrolled Courses</p>
    </div>
    <div style="background: #2ecc71; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h2 style="font-size: 36px;">{{ $student->class ?? 'N/A' }}</h2>
        <p>Current Class</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <!-- My Profile -->
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4>👤 My Profile</h4>
        <table style="margin-top: 15px; width: 100%;">
            <tr><td style="padding: 8px 0;"><strong>Name:</strong></td><td>{{ $student->name ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Email:</strong></td><td>{{ $student->email ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Phone:</strong></td><td>{{ $student->phone ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Class:</strong></td><td>{{ $student->class ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Father Name:</strong></td><td>{{ $student->profile->father_name ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Blood Group:</strong></td><td>{{ $student->profile->blood_group ?? '-' }}</td></tr>
        </table>
    </div>

    <!-- Enrolled Courses -->
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4>📚 My Enrolled Courses</h4>
        
        @if($enrolledCourses->count() > 0)
            @foreach($enrolledCourses as $course)
                <div style="border-bottom: 1px solid #eee; padding: 10px 0;">
                    <strong>{{ $course->name }}</strong><br>
                    <small>Code: {{ $course->code }} | Credits: {{ $course->credits }}</small><br>
                    <small>Teacher: {{ $course->teacher->name ?? 'Not assigned' }}</small>
                </div>
            @endforeach
        @else
            <p style="color: gray; margin-top: 15px;">No courses enrolled yet.</p>
        @endif
    </div>
</div>

<div class="alert alert-info" style="background: #e3f2fd; padding: 15px; border-radius: 8px; margin-top: 20px;">
    <strong>ℹ️ Note:</strong> As a student, you can only view your own profile and enrolled courses.
</div>

@endsection
