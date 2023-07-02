<?php

namespace App\Http\Controllers\lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use App\Models\Review;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with("category", "module")
            ->orderBy("id", "desc")
            ->paginate(6);
        return view("lecturer.courses.index", [
            "courses" => $courses,
        ]);
    }

    public function reviewCourse(Course $course)
    {
        $course = $course
            ->load("module")
            ->where("id", $course->id)
            ->firstOrFail();
        return view("lecturer.courses.course", [
            "course" => $course,
        ]);
    }

    public function reviewModule(Module $module)
    {
        $modules = Module::with("course")
            ->where("course_id", $module->course_id)
            ->get();
        $nextModule = Module::where("id", ">", $module->id)
            ->where("course_id", $module->course_id)
            ->first();

        return view("lecturer.courses.module", [
            "modules" => $modules,
            "module" => $module->load("course"),
            "nextModule" => $nextModule,
        ]);
    }

    public function indexReview()
    {
        return view("lecturer.courses.index-review", [
            "reviews" => Review::with("course")
                ->where("user_id", auth()->id())
                ->orderBy("created_at", "desc")
                ->get(),
        ]);
    }

    public function showReview(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return abort(403);
        }
        return view("lecturer.courses.show-review", [
            "review" => $review->load("course"),
        ]);
    }

    public function sendReview(Course $course)
    {
        return view("lecturer.courses.send-review", [
            "course" => $course,
        ]);
    }

    public function storeReview(Request $request, Course $course)
    {
        $validated = $request->validate([
            "content" => "required",
        ]);

        $validated = [
            "user_id" => auth()->id(),
            "course_id" => $course->id,
            "content" => $request->post("content"),
        ];

        Review::create($validated);

        return redirect(route("lecturerCourse.indexReview"))->with(
            "message",
            "Terima kasih! Masukan telah terkirim."
        );
    }
}
