<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first(); // Ambil data dari database
        return view('contact.index', compact('contact'));
    }
}
