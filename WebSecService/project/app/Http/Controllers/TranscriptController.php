<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranscriptController extends Controller
{
    public function index(){
        $transcript = [
            ['course' => 'Web Security', 'grade' => 'A'],
            ['course' => 'Database Systems', 'grade' => 'B+'],
            ['course' => 'Network Security', 'grade' => 'A-'],
        ];
        return view('transcript', compact('transcript'));
    }
}
