<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return view("admin.reviews.index", [
            "reviews" => Review::with("course")
                ->orderBy("id", "desc")
                ->get(),
        ]);
    }

    public function show(Review $review)
    {
        return view("admin.reviews.show", [
            "review" => $review->load("course"),
        ]);
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            "status" => "required",
        ]);

        Review::where("id", $review->id)->update($validated);

        return redirect(route("adminReviews"))->with(
            "message",
            "Status berhasil diubah!"
        );
    }
}
