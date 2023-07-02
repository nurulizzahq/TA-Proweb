<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ExamClass;
use App\Models\MultipleChoise;
use Illuminate\Http\Request;

class MultipleChoiseController extends Controller
{
    public function index()
    {
        return view("admin.multiplechoise.index", [
            "classes" => ExamClass::with("course")->get(),
            "courses" => Course::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "course" => "required",
        ]);

        $course = Course::where("slug", $request->post("course"))->first();
        $courseExist = ExamClass::where("course_id", $course->id)->first();
        if ($courseExist) {
            return back()->with(
                "message",
                "Maaf, kelas ini telah memiliki tersedia, silahkan pilih kelas yang lain."
            );
        }

        $course = Course::where("slug", $request->post("course"))->first();

        ExamClass::create([
            "user_id" => auth()->id(),
            "course_id" => $course->id,
        ]);

        return back()->with("message", "Kelas Ujian berhasil dibuat.");
    }

    public function indexQuestion(ExamClass $examClass)
    {
        return view("admin.multiplechoise.index-question", [
            "class" => $examClass->load("course"),
            "questions" => MultipleChoise::where(
                "exam_class_id",
                $examClass->id
            )
                ->latest()
                ->get(),
        ]);
    }

    public function createQuestion(ExamClass $examClass)
    {
        return view("admin.multiplechoise.create-question", [
            "class" => $examClass->load("course"),
            "questions" => MultipleChoise::where(
                "exam_class_id",
                $examClass->id
            )->get(),
        ]);
    }

    public function storeQuestion(Request $request, ExamClass $examClass)
    {
        $validated = $request->validate([
            "question" => "required",
            "option1" => "required",
            "option2" => "required",
            "option3" => "required",
            "option4" => "required",
            "answer" => "required",
        ]);

        $validated["exam_class_id"] = $examClass->id;
        $validated["user_id"] = auth()->id();

        MultipleChoise::create($validated);

        return redirect(
            route("multiplechoise.indexQuestion", $examClass->id)
        )->with("message", "Pilihan Ganda berhasil ditambah!");
    }

    public function editQuestion(MultipleChoise $multipleChoise)
    {
        return view("admin.multiplechoise.edit-question", [
            "class" => ExamClass::with("course")
                ->where("id", $multipleChoise->exam_class_id)
                ->first(),
            "choise" => $multipleChoise,
        ]);
    }

    public function updateQuestion(
        Request $request,
        MultipleChoise $multipleChoise
    ) {
        $validated = $request->validate([
            "question" => "required",
            "option1" => "required",
            "option2" => "required",
            "option3" => "required",
            "option4" => "required",
            "answer" => "required",
        ]);

        $validated["exam_class_id"] = $multipleChoise->exam_class_id;
        $validated["user_id"] = auth()->id();

        MultipleChoise::where("id", $multipleChoise->id)->update($validated);

        return back()->with("message", "Berhasih di update!");
    }

    public function destroyQuestion(MultipleChoise $multipleChoise)
    {
        $multipleChoise->destroy($multipleChoise->id);

        return redirect(
            route(
                "multiplechoise.indexQuestion",
                $multipleChoise->exam_class_id
            )
        )->with("message", "Berhasil di hapus!");
    }
}
