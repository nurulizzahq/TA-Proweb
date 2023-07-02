<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaygroundController extends Controller
{
    public function index()
    {
        return view("student.playgrounds.index");
    }
}
