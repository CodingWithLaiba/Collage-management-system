@extends('layouts.app') 
@section('title', 'Teachers') 
@section('page-title', 'Teachers Management') 
@section('content') 
<div style="display: flex; justify-content: space-between; margin-bottom: 20px;"> 
<h3>Teachers List</h3> 
    <a href="{{ route('teachers.create') }}" style="background: #2c3e50; color: white; padding: 
8px 16px; text-decoration: none;">+ Add Teacher</a> 
</div> 
 
@if(session('success')) 
    <div style="background: green; color: white; padding: 10px; margin-bottom: 15px;">{{ 
session('success') }}</div> 
@endif 
 
<table border="1" width="100%" cellpadding="10"> 
    <tr style="background: #34495e; color: white;"> 
        <th>ID</th><th>Name</th><th>Email</th><th>Class</th><th>Actions</th> 
    </tr> 
    @foreach($teachers as $teacher) 
    <tr> 
        <td>{{ $teacher->id }}</td> 
        <td>{{ $teacher->name }}</td> 
        <td>{{ $teacher->email }}</td> 
        <td>{{ $teacher->class ?? '-' }}</td> 
        <td> 
            <a href="{{ route('teachers.show', $teacher->id) }}">View</a> 
            <a href="{{ route('teachers.edit', $teacher->id) }}">Edit</a> 
            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" 
style="display:inline;"> 
                @csrf @method('DELETE') 
                <button type="submit" onclick="return confirm('Delete?')">Delete</button> 
            </form> 
        </td> 
    </tr> 
    @endforeach 
</table> 
 
@endsection