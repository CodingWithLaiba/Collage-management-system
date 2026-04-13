@extends('layouts.app')
@section('title', 'Teacher Details')
@section('page-title', 'Teacher Details')
@section('content')
<p><strong>Name:</strong> {{ $teacher->name }}</p>
<p><strong>Email:</strong> {{ $teacher->email }}</p>
<p><strong>Phone:</strong> {{ $teacher->phone ?? '-' }}</p>
<p><strong>Class:</strong> {{ $teacher->class ?? '-' }}</p>
<p><strong>Father Name:</strong> {{ $teacher->profile->father_name ?? '-' }}</p>
<p><strong>Address:</strong> {{ $teacher->profile->address ?? '-' }}</p>
<a href="{{ route('teachers.edit', $teacher->id) }}">Edit</a>
<a href="{{ route('teachers.index') }}">Back</a>
@endsection