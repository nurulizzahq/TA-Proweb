<?php

namespace App\Http\Controllers;

use App\Models\Assigment;
use App\Models\Room;
use App\Models\StudentAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentAssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assigment::with("studentAssignment")
            ->where([
                "user_id" => auth()->id(),
            ])
            ->orderBy("created_at", "desc")
            ->get();

        return view("student.assignments.index", [
            "assignments" => $assignments,
        ]);
    }

    public function enterRoom(Request $request, Room $room)
    {
        $assignments = Assigment::where([
            "user_id" => auth()->id(),
            "room_id" => $room->id,
        ])->get();

        if ($assignments->count() > 0) {
            return redirect(route("assignments"))->with(
                "message",
                "Kamu telah didalam Ruangan."
            );
        }

        return view("student.assignments.enter-room", [
            "room" => $room,
        ]);
    }

    public function enteredRoom(Request $request, Room $room)
    {
        $request->validate([
            "pass_code" => "numeric|required",
        ]);

        if ($request->post("pass_code") != $room->pass_code) {
            return redirect()
                ->back()
                ->with("message", "PIN Salah, harap hubungi dosen kamu.");
        }

        Assigment::updateOrCreate(
            [
                "user_id" => auth()->id(),
                "room_id" => $room->id,
            ],
            [
                "user_id" => auth()->id(),
                "room_id" => $room->id,
                "student_assigment_id" => null,
                "slug" => $room->slug,
            ]
        );

        return redirect(route("collectAssignment", $room->slug));
    }

    public function collectAssignment(Assigment $assigment)
    {
        $assignment = $assigment
            ->load(["room", "studentAssignment"])
            ->where([
                "user_id" => auth()->id(),
                "room_id" => $assigment->room->id,
            ])
            ->first();

        if (!$assignment) {
            return redirect(route("assignments"))->with(
                "message",
                "Autentikasi gagal, silahkan meminta link pada dosen terlebih dahulu."
            );
        }

        return view("student.assignments.collect-assignment", [
            "assignment" => $assignment,
        ]);
    }

    public function storeAssignment(Request $request, Assigment $assigment)
    {
        if ($request->post("is_attachment") != true) {
            $validated = $request->validate([
                "content" => "required",
            ]);
            $validated["user_id"] = auth()->id();
            $validated["room_id"] = $assigment->room_id;
            $validated["send_at"] = $request->post("status") ? now() : null;
            $validated["is_attachment"] = $request->post("is_attachment");
            $validated["slug"] = Str::upper(Str::random(25));

            $studentAttachment = StudentAssignment::create($validated);

            $assigment
                ->where("slug", $assigment->slug)
                ->where("user_id", auth()->id())
                ->update([
                    "student_assignment_id" => $studentAttachment->id,
                ]);

            return redirect(route("assignments"))->with(
                "message",
                "Tugas berhasil dikirim."
            );
        } else {
            $validated = $request->validate([
                "attachment" =>
                    "required|mimes:png,jpg,jpeg,word,pdf,zip,rar,xlsx,xlxs,txt",
            ]);
            $validated["user_id"] = auth()->id();
            $validated["room_id"] = $assigment->room_id;
            $validated["send_at"] = $request->post("status") ? now() : null;
            $validated["is_attachment"] = $request->post("is_attachment");

            $filename =
                rand(0, 9999) .
                "-" .
                $request->file("attachment")->getClientOriginalName();
            $request
                ->file("attachment")
                ->move(public_path("assets/assignments/"), $filename);
            $validated["attachment"] = $filename;
            $validated["slug"] = Str::upper(Str::random(25));

            $studentAttachment = StudentAssignment::create($validated);

            $assigment
                ->where("slug", $assigment->slug)
                ->where("user_id", auth()->id())
                ->update([
                    "student_assignment_id" => $studentAttachment->id,
                ]);

            return redirect(route("assignments"))->with(
                "message",
                "Tugas berhasil dikirim."
            );
        }
    }

    public function collectAssignmentSended(Assigment $assigment)
    {
        $assignment = $assigment
            ->with("studentAssignment", "user")
            ->where("id", $assigment->id)
            ->first();
        return view("student.assignments.collect-assignment-sended", [
            "assignment" => $assignment,
        ]);
    }

    public function storeAssignmentSended(
        Request $request,
        Assigment $assigment
    ) {
        $assignment = Assigment::with("studentAssignment")
            ->where("id", $assigment->id)
            ->first();
        if (
            $request->file("attachment") == null &&
            $assignment->studentAssignment->is_attachment == false
        ) {
            $validated = $request->validate([
                "content" => "required",
            ]);
        } else {
            if ($request->file("attachment")) {
                $validated = $request->validate([
                    "attachment" =>
                        "required|mimes:png,jpg,jpeg,word,pdf,zip,rar,xlsx,xlxs,txt",
                ]);
                $filename =
                    rand(0, 9999) .
                    "-" .
                    $request->file("attachment")->getClientOriginalName();
                $request
                    ->file("attachment")
                    ->move(public_path("assets/assignments/"), $filename);
                $validated["attachment"] = $filename;
            }
        }

        $validated["send_at"] = $request->post("status") ? now() : null;
        $validated["user_id"] = auth()->id();
        $validated["room_id"] = $assigment->room_id;

        StudentAssignment::where("id", $assignment->student_assignment_id)
            ->where("user_id", auth()->id())
            ->update($validated);

        return back()->with("message", "Tugas berhasil diubah.");
    }
}
