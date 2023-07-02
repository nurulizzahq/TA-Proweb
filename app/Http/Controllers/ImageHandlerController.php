<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageHandlerController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->file("image")) {
            return response()->json([
                "success" => false,
                "location" => "file not found",
            ]);
        }

        $filename = rand(0, 9999) . "." . $request->file("image")->extension();
        $request
            ->file("image")
            ->move(public_path("assets/images/modules/"), $filename);
        $imageUrl = asset("assets/images/modules/" . $filename);

        return response()->json([
            "success" => true,
            "location" => $imageUrl,
        ]);
    }
}
