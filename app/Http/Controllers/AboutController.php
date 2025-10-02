<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team; // ✅ Import model Team

class AboutController extends Controller
{
    public function index()
    {
        // Ambil semua data tim dari database
        $teams = Team::all();

        // Lempar data ke view about.blade.php
        return view('about', compact('teams'));
    }
}
