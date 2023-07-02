<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Course $course)
    {
        $modules = Module::where("course_id", $course->id)->get();

        return view("admin.modules.index", [
            "course" => $course,
            "modules" => $modules,
        ]);
    }

    public function create(Course $course)
    {
        return view("admin.modules.create", [
            "course" => $course,
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            "title" => "required",
            "yt_link" => "nullable",
            "content" => "required",
        ]);
        $validated["course_id"] = $course->id;

        Module::create($validated);

        return redirect()
            ->to(route("module", $course->slug))
            ->with("message", "Modul berhasil dibuat!");
    }

    public function show(Module $module)
    {
        return view("admin.modules.show", [
            "module" => $module,
        ]);
    }

    public function edit(Module $module)
    {
        return view("admin.modules.edit", [
            "module" => $module,
        ]);
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            "title" => "required",
            "yt_link" => "nullable",
            "content" => "required",
        ]);

        Module::where("id", $module->id)->update($validated);

        return redirect()
            ->back()
            ->with("message", "Modul berhasil diupdate!");
    }

    public function destroy(Module $module)
    {
        $course = Course::where("id", $module->course_id)->first();
        $module->destroy($module->id);
        return redirect(route("module", $course->slug));
    }
}
