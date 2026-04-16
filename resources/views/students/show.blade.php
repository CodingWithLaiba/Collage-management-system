@extends('layouts.app')

@section('title', 'Student Details')
@section('page-title', 'Student Details: ' . $student->name)

@section('content')

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    
    <!-- Basic Information Card -->
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4 style="margin-bottom: 15px; color: #2c3e50;">📋 Basic Information</h4>
        <table style="width: 100%;">
            <tr><td style="padding: 8px 0;"><strong>ID:</strong></td><td>{{ $student->id }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Name:</strong></td><td>{{ $student->name }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Email:</strong></td><td>{{ $student->email }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Phone:</strong></td><td>{{ $student->phone ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Class:</strong></td><td>{{ $student->class ?? '-' }}</td></tr>
        </table>
    </div>

    <!-- Additional Information Card -->
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <h4 style="margin-bottom: 15px; color: #2c3e50;">👨‍👦 Family Information</h4>
        <table style="width: 100%;">
            <tr><td style="padding: 8px 0;"><strong>Father's Name:</strong></td><td>{{ $student->profile->father_name ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0;"><strong>Address:</strong></td><td>{{ $student->profile->address ?? '-' }}</td></tr>
        </table>
    </div>
</div>

<div style="margin-top: 20px; text-align: center;">
    <a href="{{ route('students.edit', $student->id) }}" 
       style="background: #f39c12; color: white; padding: 10px 30px; text-decoration: none; border-radius: 5px;">
        ✏️ Edit Student
    </a>
    <a href="{{ route('students.index') }}" 
       style="background: #95a5a6; color: white; padding: 10px 30px; text-decoration: none; border-radius: 5px; margin-left: 10px;">
        Back to List
    </a>
</div>

@endsection