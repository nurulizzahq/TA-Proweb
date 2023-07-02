<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLearned;
use App\Models\Module;
use App\Models\ModuleLearned;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function index(Course $course)
    {
        $courseWithModule = $course
            ->with("module")
            ->where("id", $course->id)
            ->firstOrFail();
        return view("student.learn.index", [
            "course" => $courseWithModule,
        ]);
    }

    public function storeUserLearnedCourse(Module $module)
    {
        $checkLearned = CourseLearned::where("user_id", auth()->user()->id)
            ->where("course_id", $module->course_id)
            ->first();

        if (!$checkLearned) {
            CourseLearned::create([
                "user_id" => auth()->user()->id,
                "course_id" => $module->course_id,
                "is_completed" => false,
            ]);
        }

        return redirect(route("learn.show", $module->slug))->with(
            "validated-first-module",
            "First Module"
        );
    }

    public function show(Module $module)
    {
        // check if course not learned yet.
        $checkCourseLearned = CourseLearned::where([
            "user_id" => auth()->user()->id,
            "course_id" => $module->course_id,
        ])->first();

        if (!$checkCourseLearned) {
            return redirect(route("learn", $module->course->slug))->with(
                "message",
                'Maaf, anda belum memulai belajar course ini, harap klik di tombol "Mulai Belajar".'
            );
        }

        // check if student skip module
        $moduleLearned = ModuleLearned::with("module")
            ->where([
                "user_id" => auth()->user()->id,
                "course_id" => $module->course_id,
            ])
            ->latest()
            ->first();

        if ($moduleLearned == null) {
            if (!session("validated-first-module")) {
                return redirect(route("learn", $module->course->slug));
            }
        }

        $countModuleLearned = ModuleLearned::with("module")
            ->where([
                "user_id" => auth()->user()->id,
                "course_id" => $module->course_id,
            ])
            ->count();

        if ($countModuleLearned > 0) {
            if (!session()->has("nextModule")) {
                if ($moduleLearned->module_id < $module->id) {
                    return redirect(
                        route("learn.show", $moduleLearned->module->slug)
                    )->with(
                        "message",
                        "Maaf, kamu belum menyelesaikan course sebelumnya."
                    );
                }
            }
        }

        $modules = Module::where("course_id", $module->course_id)->get();
        $nextModule = Module::where("id", ">", $module->id)
            ->where("course_id", $module->course_id)
            ->first();

        return view("student.learn.show", [
            "modules" => $modules,
            "module" => $module,
            "nextModule" => $nextModule,
        ]);
    }

    public function storeFisnishedModule(Module $module)
    {
        $check = ModuleLearned::where([
            "user_id" => auth()->user()->id,
            "course_id" => $module->course_id,
            "module_id" => $module->id,
        ])->count();

        if ($check == 0) {
            ModuleLearned::create([
                "course_id" => $module->course_id,
                "user_id" => auth()->user()->id,
                "module_id" => $module->id,
            ]);
        }

        return redirect(
            route("learn.show", request()->post("nextModule"))
        )->with("nextModule", "Next Module");
    }

    public function storeFisnishedCourse(Module $module)
    {
        ModuleLearned::create([
            "course_id" => $module->course_id,
            "user_id" => auth()->user()->id,
            "module_id" => $module->id,
        ]);

        $query = CourseLearned::where("user_id", auth()->user()->id)
            ->where("course_id", $module->course_id)
            ->first();

        if (!$query->is_completed) {
            CourseLearned::where("user_id", auth()->user()->id)
                ->where("course_id", $module->course_id)
                ->update([
                    "is_completed" => true,
                ]);
        }

        return redirect(route("dashboard"))->with(
            "message",
            "Selamat Kamu telah menyelesaikan " . $module->course->name . "! 🎉"
        );
    }
}
