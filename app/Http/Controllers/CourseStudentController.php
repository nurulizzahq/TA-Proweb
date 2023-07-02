<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    public function index()
    {
        $courses = Course::with("category", "module")
            ->orderBy("id", "asc")
            ->paginate(6);
        return view("student.course.index", [
            "courses" => $courses,
        ]);
    }
}
