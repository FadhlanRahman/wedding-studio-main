<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact()
    {
        $contact = Contact::first(); // ambil data pertama (karena 1 record saja)
        return view('contact.index', compact('contact'));
    }
}
