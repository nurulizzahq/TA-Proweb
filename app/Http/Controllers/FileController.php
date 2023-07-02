<?php

namespace App\Http\Controllers;

use App\Models\StudentAssignment;

class FileController extends Controller
{
    public function downloadTask($slug)
    {
        $assignment = StudentAssignment::where("slug", $slug)->first();
        $file = public_path("assets/assignments/" . $assignment->attachment);
        return response()->download($file);
    }
}
