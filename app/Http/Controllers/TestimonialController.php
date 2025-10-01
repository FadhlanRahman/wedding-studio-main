<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create($data);

        return redirect()->back()->with('success', 'Terima kasih, testimoni Anda sudah dikirim!');
    }
}
