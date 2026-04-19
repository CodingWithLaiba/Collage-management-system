@extends('layouts.app')
@section('title', 'Courses')
@section('page-title', 'Courses Management')
@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 
20px;">
    <h3>Courses List</h3>
    <a href="{{ route('courses.create') }}"
        style="background: #2c3e50; color: white; padding: 8px 16px; text-decoration: none; 
border-radius: 5px;">
        Add New Course
    </a>
</div>

@if(session('success'))
<div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
    {{ session('error') }}
</div>
@endif

<table border="1" width="100%" cellpadding="12" style="border-collapse: collapse;">
    <thead style="background: #34495e; color: white;">
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Credits</th>
            <th>Teacher</th>
            <th>Enrolled Students</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->code }}</td>
            <td style="text-align: center;">{{ $course->credits }}</td>
            <td>
                @if($course->teacher)
                {{ $course->teacher->name }}
                @else
                <span style="color: gray;">Not Assigned</span>
                @endif
            </td>
            <td style="text-align: center;">
                <span style="background: #3498db; color: white; padding: 2px 8px; border-radius: 
12px;">
                    {{ $course->students->count() }}
                </span>
            </td>
            <td style="text-align: center;">
                @if($course->status == 'active')
                <span style="background: #27ae60; color: white; padding: 2px 8px; border-radius: 
12px;">Active</span>
                @else
                <span style="background: #e74c3c; color: white; padding: 2px 8px; border-radius: 
12px;">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('courses.show', $course->id) }}"
                    style="color: blue; margin-right: 10px;"> View</a>
                <a href="{{ route('courses.edit', $course->id) }}"
                    style="color: orange; margin-right: 10px;"> Edit</a>
                <form action="{{ route('courses.destroy', $course->id) }}"
                    method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="background: none; border: none; color: red; cursor: pointer;"
                        onclick="return confirm('Are you sure you want to delete this course?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center; padding: 40px;">
                No courses found! Click "Add New Course" to create one.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection