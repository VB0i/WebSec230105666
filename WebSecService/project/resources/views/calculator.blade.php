@extends('layouts.master')

@section('title', 'GPA Calculator')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">GPA Simulator</h2>
    <div class="card p-4 shadow-sm">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Title</th>
                    <th>Credit Hours</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody id="coursesTable">
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course['code'] }}</td>
                    <td>{{ $course['title'] }}</td>
                    <td class="credit-hours">{{ $course['credit_hours'] }}</td>
                    <td>
                        <select class="form-select grade">
                            <option value="4">A (4.0)</option>
                            <option value="3.7">A- (3.7)</option>
                            <option value="3.3">B+ (3.3)</option>
                            <option value="3.0">B (3.0)</option>
                            <option value="2.7">B- (2.7)</option>
                            <option value="2.3">C+ (2.3)</option>
                            <option value="2.0">C (2.0)</option>
                            <option value="1.7">C- (1.7)</option>
                            <option value="1.3">D+ (1.3)</option>
                            <option value="1.0">D (1.0)</option>
                            <option value="0">F (0.0)</option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary w-100" onclick="calculateGPA()">Calculate GPA</button>
        <h3 class="text-center mt-4">GPA: <span id="gpaResult">0.00</span></h3>
    </div>
</div>

<script>
    function calculateGPA() {
        let totalCredits = 0;
        let totalPoints = 0;

        let rows = document.querySelectorAll("#coursesTable tr");
        rows.forEach(row => {
            let creditHours = parseFloat(row.querySelector(".credit-hours").innerText);
            let grade = parseFloat(row.querySelector(".grade").value);

            totalCredits += creditHours;
            totalPoints += creditHours * grade;
        });

        let gpa = totalCredits > 0 ? (totalPoints / totalCredits).toFixed(2) : "0.00";
        document.getElementById("gpaResult").innerText = gpa;
    }
</script>
@endsection
