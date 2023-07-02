<?php

namespace App\Http\Controllers;

use App\Mail\LecturerAccountInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;

class RegisteredLecturer extends Controller
{
    public function index()
    {
        $lecturers = User::with("roles")
            ->whereHas("roles", function ($query) {
                $query->where("name", "lecturer");
            })
            ->latest()
            ->get();

        return view("admin.registered-lecturer.index", [
            "lecturers" => $lecturers->load("roles"),
        ]);
    }

    public function store(Request $request)
    {
        $generatePassword = Random::generate("8", "0-9a-z");
        $validation = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
        ]);
        $validation["password"] = bcrypt($generatePassword);

        Mail::to($request->post("email"))->send(
            new LecturerAccountInformation([
                "email" => $request->post("email"),
                "password" => $generatePassword,
            ])
        );

        $lecturer = User::create($validation);
        $lecturer->assignRole("lecturer");

        return back()->with(
            "message",
            "Akun berhasil dibuat dan password telah dikirim ke email yang telah di daftar."
        );
    }

    public function destroy(User $user)
    {
        $user->destroy($user->id);

        return back()->with("message", "Akun berhasil dihapus.");
    }
}
