@extends('layouts.app')

@section('title', 'Course Details')
@section('page-title', 'Course Details: ' . $course->name)

@section('content')

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

    <!-- Course Information Card -->
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4 style="margin-bottom: 15px; color: #2c3e50;"> Course Information</h4>
        <table style="width: 100%;">
            <tr>
                <td style="padding: 8px 0;"><strong>ID:</strong></td>
                <td>{{ $course->id 
}}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Course Name:</strong></td>
                <td>{{ $course
>name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Course Code:</strong></td>
                <td><strong>{{
$course->code }}</strong></td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Credits:</strong></td>
                <td>{{ $course->credits 
}}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Duration:</strong></td>
                <td>{{ $course
>duration_hours ?? 'N/A' }} hours</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Status:</strong></td>
                <td>
                    @if($course->status == 'active')
                    <span style="background: #27ae60; color: white; padding: 2px 8px; border-radius: 
12px;">Active</span>
                    @else
                    <span style="background: #e74c3c; color: white; padding: 2px 8px; border-radius: 
12px;">Inactive</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Description:</strong></td>
                <td>{{ $course
>description ?? 'No description' }}</td>
            </tr>
        </table>
    </div>

    <!-- Teacher Information Card -->
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4 style="margin-bottom: 15px; color: #2c3e50;"> Teacher Information (One-to
            Many)</h4>
        @if($course->teacher)
        <table style="width: 100%;">
            <tr>
                <td style="padding: 8px 0;"><strong>Teacher Name:</strong></td>
                <td>{{ $course
>teacher->name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Qualification:</strong></td>
                <td>{{ $course
>teacher->qualification ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Specialization:</strong></td>
                <td>{{ $course
>teacher->specialization ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Experience:</strong></td>
                <td>{{ $course
>teacher->experience_years }} years</td>
            </tr>
        </table>
        @else
        <p style="color: gray;">No teacher assigned to this course yet.</p>
        @endif
    </div>
</div>

<!-- Enrolled Students Section (Many-to-Many) -->
<div style="margin-top: 20px; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
    <h4 style="margin-bottom: 15px; color: #2c3e50;"> Enrolled Students (Many-to
        Many)</h4>

    @if($course->students && $course->students->count() > 0)
    <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">
        <thead style="background: #ecf0f1;">
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
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
                    <span style="background: @if($student->pivot->status == 'enrolled') #27ae60 
                            @elseif($student->pivot->status == 'completed') #3498db 
                            @else #e74c3c @endif;  
                            color: white; padding: 2px 8px; border-radius: 12px;">
                        {{ ucfirst($student->pivot->status) }}
                    </span>
                </td>
                <td>{{ $student->pivot->grade ?? 'Not graded' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="margin-top: 10px;"><strong>Total Enrolled:</strong> {{ $course->students
>count() }} students</p>
    @else
    <p style="color: gray;">No students enrolled in this course yet.</p>
    @endif
</div>

<div style="margin-top: 20px; text-align: center;">
    <a href="{{ route('courses.edit', $course->id) }}"
        style="background: #f39c12; color: white; padding: 10px 30px; text-decoration: none; 
border-radius: 5px;">
        Edit Course
    </a>
    <a href="{{ route('courses.index') }}"
        style="background: #95a5a6; color: white; padding: 10px 30px; text-decoration: none; 
border-radius: 5px; margin-left: 10px;">
        Back to List
    </a>
</div>

@endsection