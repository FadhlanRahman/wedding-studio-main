<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Team;

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
    // Halaman Services
    // =================
    public function services()
    {
        return view('admin.services');
    }

    // =================
    // About Admin Panel
    // =================
    public function about()
    {
        $teams = Team::all();
        return view('admin.about', compact('teams')); 
    }

    // === Team ===
    public function storeTeam(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('teams', 'public');
        }

        Team::create([
            'name'  => $request->name,
            'role'  => $request->role,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.about')->with('success', 'Tim berhasil ditambahkan!');
    }

    public function updateTeam(Request $request, Team $team)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = $team->photo;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('teams', 'public');
        }

        $team->update([
            'name'  => $request->name,
            'role'  => $request->role,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.about')->with('success', 'Tim berhasil diperbarui!');
    }

    public function destroyTeam(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.about')->with('success', 'Tim berhasil dihapus!');
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
