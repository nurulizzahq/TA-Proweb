<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLearned;
use App\Models\Module;
use App\Models\ModuleLearned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with("category")->get();

        return view("admin.courses.index", [
            "courses" => $courses,
        ]);
    }

    public function create()
    {
        $categories = CourseCategory::all();

        return view("admin.courses.create", [
            "categories" => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "description" => "required",
            "course_category_id" => "required|numeric",
            "thumbnail" => "required|mimes:jpg,jpeg,png",
        ]);

        $filename =
            rand(0, 9999) .
            "-" .
            $request->file("thumbnail")->getClientOriginalName();
        $request
            ->file("thumbnail")
            ->move(public_path("assets/images/thumbnails/"), $filename);
        $validated["thumbnail"] = $filename;

        Course::create($validated);

        return redirect(route("courses"))->with(
            "message",
            "Kelas Berhasil Ditambah!"
        );
    }

    public function edit(Course $course)
    {
        $categories = CourseCategory::all();

        return view("admin.courses.edit", [
            "categories" => $categories,
            "course" => $course,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            "name" => "required",
            "description" => "required",
            "course_category_id" => "required|numeric",
            "thumbnail" => "mimes:jpg,jpeg,png",
        ]);

        if ($request->file("thumbnail")) {
            $filename =
                rand(0, 9999) .
                "-" .
                $request->file("thumbnail")->getClientOriginalName();
            $request
                ->file("thumbnail")
                ->move(public_path("assets/images/thumbnails/"), $filename);
            $validated["thumbnail"] = $filename;
        }

        Course::where("slug", $course->slug)->update($validated);

        return redirect()
            ->back()
            ->with("message", "Course berhasil diperbarui!");
    }

    public function destroy(Course $course)
    {
        $imagePath = public_path(
            "assets/images/thumbnails/" . $course->thumbnail
        );

        if (File::exists($imagePath)) {
            unlink($imagePath);
        }

        $course->destroy($course->id);
        Module::where("course_id", $course->id)->delete();
        CourseLearned::where("course_id", $course->id)->delete();
        ModuleLearned::where("course_id", $course->id)->delete();

        return redirect(route("courses"))->with(
            "message",
            "Course berhasil dihapus!"
        );
    }
}
