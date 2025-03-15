@extends('layouts.master')

@section('title', 'Transcript')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Student Transcript</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Course</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transcript as $entry)
                <tr>
                    <td>{{ $entry['course'] }}</td>
                    <td>{{ $entry['grade'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection