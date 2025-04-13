<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculaterController extends Controller
{
    public function index(){
        $courses = [
            ['code' => 'CS101', 'title' => 'Linux and Shell Programming', 'credit_hours' => 3],
            ['code' => 'CS102', 'title' => 'Digital Forensics Fundamental', 'credit_hours' => 3],
            ['code' => 'MATH101', 'title' => 'CET Project II', 'credit_hours' => 4],
            ['code' => 'PHY101', 'title' => 'Web and Security Technologies', 'credit_hours' => 3],
            ['code' => 'ENG101', 'title' => 'Network Operation', 'credit_hours' => 3],
        ];
        return view('calculator', compact('courses'));
    }
}
