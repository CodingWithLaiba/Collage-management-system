@extends('layouts.app') 
 
@section('title', 'Add Teacher') 
@section('page-title', 'Add New Teacher') 
 
@section('content') 
 
<form action="{{ route('teachers.store') }}" method="POST"> 
    @csrf 
     
    <label>Name:</label> 
    <input type="text" name="name" required><br><br> 
     
    <label>Email:</label> 
    <input type="email" name="email" required><br><br> 
     
    <label>Phone:</label> 
    <input type="text" name="phone"><br><br> 
     
    <label>Class:</label> 
    <input type="text" name="class"><br><br> 
     
    <label>Father Name:</label> 
    <input type="text" name="father_name"><br><br> 
     
    <label>Address:</label> 
    <textarea name="address"></textarea><br><br> 
     
    <button type="submit">Save Teacher</button> 
    <a href="{{ route('teachers.index') }}">Cancel</a> 
</form> 
 
@endsection 