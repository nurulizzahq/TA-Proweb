<?php

namespace App\Http\Controllers;

use App\Models\CourseLearned;
use App\Models\ExamResult;
use App\Models\Review;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());

        if ($user->hasRole("lecturer")) {
            $reviews = Review::with("course")
                ->where("user_id", $user->id)
                ->where("status", "!=", "Pending")
                ->get();

            // $studentAssignments = StudentAssignment::with(['room' => function($room) {
            //     $room->where('user_id', auth()->id());
            // }])->get();

            return view("user.dashboard", [
                "reviews" => $reviews,
                // 'assignments' => $studentAssignments
            ]);
        } elseif ($user->hasRole("student")) {
            $courseLearneds = CourseLearned::with("course")
                ->where("user_id", auth()->user()->id)
                ->orderBy("id", "desc")
                ->get();
            return view("user.dashboard", [
                "courseLearneds" => $courseLearneds,
            ]);
        }

        $examResults = ExamResult::with("user", "course")
            ->orderBy("id", "desc")
            ->get();
        return view("user.dashboard", [
            "examResults" => $examResults,
        ]);
    }
}
