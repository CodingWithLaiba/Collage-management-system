@extends('layouts.app') 
 
@section('title', 'Edit Teachers') 
@section('page-title', 'Edit Teachers: ' . $teacher->name) 
 
@section('content') 
 
<form action="{{ route('teachers.update', $teacher->id) }}" method="POST"> 
    @csrf 
    @method('PUT') 
     
    <label>Name:</label> 
    <input type="text" name="name" value="{{ $teacher->name }}" required><br><br> 
     
    <label>Email:</label> 
    <input type="email" name="email" value="{{ $teacher->email }}" required><br><br> 
     
    <label>Phone:</label> 
    <input type="text" name="phone" value="{{ $teacher->phone }}"><br><br> 
     
    <label>Class:</label> 
    <input type="text" name="class" value="{{ $teacher->class }}"><br><br> 
     
    <label>Father Name:</label> 
    <input type="text" name="father_name" value="{{ $teacher->profile->father_name ?? '' 
}}"><br><br> 
     
    <label>Address:</label> 
    <textarea name="address">{{ $teacher->profile->address ?? '' }}</textarea><br><br> 
     
    <button type="submit">Update Teacher</button> 
    <a href="{{ route('teachers.index') }}">Cancel</a> 
</form> 
 
@endsection