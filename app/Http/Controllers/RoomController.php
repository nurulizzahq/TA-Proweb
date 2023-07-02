<?php

namespace App\Http\Controllers;

use App\Models\Assigment;
use App\Models\Room;
use App\Models\StudentAssignment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with("studentAssignment")
            ->where("user_id", auth()->user()->id)
            ->orderBy("created_at", "desc")
            ->get();
        return view("lecturer.rooms.index", [
            "rooms" => $rooms,
        ]);
    }

    public function create()
    {
        return view("lecturer.rooms.create");
    }

    public function store(Request $request)
    {
        $closed_at = Carbon::parse(
            $request->post("closed_at")
        )->toDateTimeString();

        $validated = $request->validate([
            "name" => "required",
            "description" => "required",
            "pass_code" => "required|numeric|min:4",
            "closed_at" => "required",
        ]);

        $validated["closed_at"] = $closed_at;
        $validated["user_id"] = auth()->user()->id;
        $validated["slug"] = Random::generate(15, "a-z");

        Room::create($validated);

        return redirect(route("rooms"))->with(
            "message",
            "Ruangan berhasil dibuat."
        );
    }

    public function edit(Room $room)
    {
        return view("lecturer.rooms.edit", [
            "room" => $room,
        ]);
    }

    public function update(Request $request, Room $room)
    {
        $closed_at = Carbon::parse(
            $request->post("closed_at")
        )->toDateTimeString();

        $validated = $request->validate([
            "name" => "required",
            "description" => "required",
            "pass_code" => "required|numeric|min:4",
            "closed_at" => "required",
        ]);

        $validated["closed_at"] = $closed_at;
        $validated["user_id"] = auth()->user()->id;
        $validated["slug"] = Random::generate(15, "a-z");

        $room->update($validated);

        return redirect(route("rooms"))->with(
            "message",
            "Ruangan berhasil diperbarui."
        );
    }

    public function destroy(Room $room)
    {
        $room->destroy($room->id);
        return redirect(route("rooms"))->with(
            "message",
            "Ruangan berhasil dihapus."
        );
    }

    public function studentAssigments(Room $room)
    {
        if ($room->user_id != auth()->id()) {
            return abort(403);
        }

        $assignments = Assigment::with(["room", "user", "studentAssignment"])
            ->whereRelation("studentAssignment", "send_at", "!=", null)
            ->where([
                "room_id" => $room->id,
            ])
            ->get();

        return view("lecturer.assignments.index", [
            "assignments" => $assignments,
        ]);
    }

    public function studentAssigmentsView($slug)
    {
        $assignment = StudentAssignment::where("slug", $slug)->first();
        $room = Room::where("id", $assignment->room_id)->first();
        $user = User::where("id", $assignment->user_id)->first();

        return view("lecturer.assignments.view", [
            "assignment" => $assignment,
            "room" => $room,
            "user" => $user,
        ]);
    }
}
