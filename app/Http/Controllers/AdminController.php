<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;

class AdminController extends Controller
{
    // =================
    // Dashboard Admin
    // =================
    public function index()
    {
        // Ambil semua booking untuk hitung total income
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
        // Gunakan paginate agar bisa dipanggil dengan ->links() di Blade
        $bookings = Booking::orderBy('booking_date', 'asc')->paginate(10);

        return view('admin.calendar', compact('bookings'));
    }

    //about admin//
        public function about()
    {
        return view('admin.about'); 
    }

    //contact admin//
        public function contact()
    {
        return view('admin.contact'); 
    }

    //services admin//
        public function services()
    {
        return view('admin.services'); 
    }

    //about portofolio//
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


