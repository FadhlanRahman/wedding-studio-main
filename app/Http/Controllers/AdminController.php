<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Service;

class AdminController extends Controller
{
    // =================
    // Dashboard Admin
    // =================
    public function index()
    {
        $bookings     = Booking::orderBy('booking_date', 'asc')->get();
        $totalIncome  = $bookings->sum('total_price');
        $totalUsers   = User::count();

        return view('admin.dashboard', compact('bookings', 'totalIncome', 'totalUsers'));
    }

    // =================
    // Akun Terdaftar
    // =================
    public function accounts()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.accounts', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.accounts.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.accounts')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Akun berhasil dihapus!');
    }

    // =================
    // Kalender Booking
    // =================
    public function calendar()
    {
        $bookings = Booking::orderBy('booking_date', 'asc')->paginate(10);
        return view('admin.calendar', compact('bookings'));
    }

    // =================
    // Halaman About
    // =================
    public function about()
    {
        return view('admin.about'); 
    }

    // =================
    // CRUD Contact
    // =================
    public function contactIndex()
    {
        $contact = Contact::first();
        return view('admin.contact.index', compact('contact'));
    }

    public function contactEdit()
    {
        $contact = Contact::first();
        return view('admin.contact.edit', compact('contact'));
    }

    public function contactUpdate(Request $request)
    {
        $request->validate([
            'phone'    => 'nullable|string|max:20',
            'email'    => 'nullable|email',
            'address'  => 'nullable|string',
            'instagram'=> 'nullable|string',
            'whatsapp' => 'nullable|string',
            'map_url'  => 'nullable|string',
        ]);

        $contact = Contact::first() ?? new Contact();
        $contact->fill($request->only([
            'phone', 'email', 'address', 'instagram', 'whatsapp', 'map_url'
        ]));
        $contact->save();

        return redirect()->route('admin.contact')->with('success', 'Kontak berhasil diperbarui.');
    }

    // =================
    // CRUD Services (pindahan dari ServicesController)
    // =================
    public function servicesIndex()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function servicesCreate()
    {
        return view('admin.services.create');
    }

    public function servicesStore(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'icon'        => 'nullable|string',
        ]);

        Service::create($request->only(['title', 'description', 'price', 'icon']));

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service berhasil ditambahkan!');
    }

    public function servicesEdit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function servicesUpdate(Request $request, Service $service)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'icon'        => 'nullable|string',
        ]);

        $service->update($request->only(['title', 'description', 'price', 'icon']));

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service berhasil diperbarui!');
    }

    public function servicesDestroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')
                         ->with('success', 'Service berhasil dihapus!');
    }

    // =================
    // Halaman Portofolio
    // =================
    public function portofolio()
    {
        return view('admin.portofolio'); 
    }

    // =================
    // Profil Admin
    // =================
    public function profile()
    {
        $admin = auth()->user();
        return view('admin.profile', compact('admin'));
    }
}
