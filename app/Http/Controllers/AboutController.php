<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team; // tambahkan model Team

class AboutController extends Controller
{
    public function index()
    {
        // Ambil semua data tim dari database
        $teams = Team::all();

        // lempar ke view about/index.blade.php
        return view('about.index', compact('teams'));
    }
}
