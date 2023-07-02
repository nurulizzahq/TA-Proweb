<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\MultipleChoise;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Course $course)
    {
        $checkData = $course->load([
            "exam.multipleChoise",
            "courseLearned" => function ($courseLearnded) use ($course) {
                $courseLearnded
                    ->where("course_id", $course->id)
                    ->where("user_id", auth()->id())
                    ->where("is_completed", true);
            },
        ]);

        // check if exam not exsist
        if (
            $checkData->exam->count() == 0 ||
            $checkData->exam[0]->multipleChoise->count() == 0
        ) {
            return back()->with(
                "message",
                "Maaf, latihan soal belum tersedia."
            );
        }

        // check if user not learned course
        if ($checkData->courseLearned->count() == 0) {
            return back()->with(
                "message",
                "Maaf, kamu harus menyelesaikan kelas terlebih dahulu."
            );
        }

        $examResult = ExamResult::where("user_id", auth()->id())
            ->where("course_id", $course->id)
            ->first();

        // check if user is already submit exam
        if ($examResult != null) {
            return view("student.exam.result", [
                "data" => $examResult,
            ]);
        }

        return view("student.exam.index", [
            "courseWithExam" => $course->load("exam.multipleChoise"),
        ]);
    }

    public function store(Course $course, Request $request)
    {
        $userAnswers = $request->post("answers");
        $correctAnswers = MultipleChoise::pluck("answer", "id")->toArray();

        $correctCount = 0;
        $wrongCount = 0;

        foreach ($userAnswers as $questionId => $userAnswer) {
            $correctAnswer = $correctAnswers[$questionId];

            if ($userAnswer == $correctAnswer) {
                $correctCount++;
            } else {
                $wrongCount++;
            }
        }

        $totalQuestions = $correctCount + $wrongCount;

        $score = ($correctCount / $totalQuestions) * 100;

        $score = round($score, 2);
        $score = (int) $score;

        $insert = ExamResult::create([
            "user_id" => auth()->id(),
            "course_id" => $course->id,
            "exam_class_id" => $course->exam[0]->id,
            "correct_count" => $correctCount,
            "wrong_count" => $wrongCount,
            "score" => $score,
        ]);

        return back();
    }
}
