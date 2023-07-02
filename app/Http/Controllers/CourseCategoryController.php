<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::all();
        return view("admin.categories.index", [
            "categories" => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
        ]);

        CourseCategory::create($validated);

        return redirect()
            ->back()
            ->with("message", "Kategori berhasil dibuat.");
    }

    public function update(Request $request, CourseCategory $courseCategory)
    {
        $validated = $request->validate([
            "name" => "required",
        ]);

        $courseCategory->update($validated);

        return redirect()
            ->back()
            ->with("message", "Kategori berhasil ubah.");
    }

    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->destroy($courseCategory->id);

        return redirect()
            ->back()
            ->with("message", "Kategori berhasil dihapus.");
    }
}
