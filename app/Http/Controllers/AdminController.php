<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\PinjamanAksesoris;
use App\Models\TransaksiPinjaman;

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

        return redirect()->route('admin.accounts.index')->with('success', 'Akun berhasil diperbarui!');
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
    // Kontak + Testimoni
    // =================
    public function contactIndex()
    {
        $contact = Contact::first();
        $testimonials = Testimonial::latest()->get(); // ✅ ambil semua testimoni
        return view('admin.contact.index', compact('contact', 'testimonials'));
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

        return redirect()->route('admin.contact.index')->with('success', 'Kontak berhasil diperbarui.');
    }

    public function testimonialDestroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }

        public function publish($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_published = true;
        $testimonial->save();

        return redirect()->back()->with('success', 'Testimoni berhasil ditampilkan di halaman user!');
    }

    public function unpublish($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_published = false;
        $testimonial->save();

        return redirect()->back()->with('success', 'Testimoni disembunyikan dari halaman user!');
    }

    // =================
    // CRUD Services
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
            'pdf_file'    => 'nullable|mimes:pdf|max:5120', // ✅ ubah sesuai name input
        ]);

        $pdfPath = null;

        // ✅ Perbaikan: simpan file PDF dengan benar
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('services/pdf', 'public');
        }

        // ✅ Simpan data ke database
        Service::create([
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'icon'        => $request->icon,
            'pdf_path'    => $pdfPath,
        ]);

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
        'pdf_file'    => 'nullable|mimes:pdf|max:5120',
    ]);

    $pdfPath = $service->pdf_path;

    if ($request->hasFile('pdf_file')) {
        $pdfPath = $request->file('pdf_file')->store('services/pdf', 'public');
    }

    $service->update([
        'title'       => $request->title,
        'description' => $request->description,
        'price'       => $request->price,
        'icon'        => $request->icon,
        'pdf_path'    => $pdfPath,
    ]);

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
    // Profil Admin
    // =================
    public function profile()
    {
        $admin = auth()->user();
        return view('admin.profile', compact('admin'));
    }

// =================
// Pinjaman Aksesoris
// =================
public function pinjamanIndex()
{
    $pinjaman = PinjamanAksesoris::latest()->get();

    return view(
        'admin.pinjaman.index',
        compact('pinjaman')
    );
}

// =================
// Data Penyewaan User
// =================
public function transaksiPinjaman()
{
    $transaksi = TransaksiPinjaman::with('barang')
        ->latest()
        ->get();

    return view(
        'admin.pinjaman.transaksi',
        compact('transaksi')
    );
}

public function pinjamanCreate()
{
    return view('admin.pinjaman.create');
}

public function pinjamanStore(Request $request)
{
    $request->validate([
        'nama_barang'    => 'required|string|max:255',
        'stok'           => 'required|integer|min:0',
        'harga'          => 'required|numeric|min:0',
        'harga_per_hari' => 'required|numeric|min:0',
        'foto_barang'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $fotoPath = null;

    if ($request->hasFile('foto_barang')) {
        $fotoPath = $request->file('foto_barang')->store('pinjaman', 'public');
    }

    \App\Models\PinjamanAksesoris::create([
        'nama_barang'    => $request->nama_barang,
        'stok'           => $request->stok,
        'harga'          => $request->harga,
        'harga_per_hari' => $request->harga_per_hari,
        'foto_barang'    => $fotoPath,
    ]);

    return redirect()->route('admin.pinjaman-aksesoris.index')
        ->with('success', 'Data pinjaman aksesoris berhasil ditambahkan!');
}

public function pinjamanEdit($id)
{
    $pinjaman = \App\Models\PinjamanAksesoris::findOrFail($id);

    return view('admin.pinjaman.edit', compact('pinjaman'));
}

public function pinjamanUpdate(Request $request, $id)
{
    $pinjaman = \App\Models\PinjamanAksesoris::findOrFail($id);

    $request->validate([
        'nama_barang'    => 'required|string|max:255',
        'stok'           => 'required|integer|min:0',
        'harga'          => 'required|numeric|min:0',
        'harga_per_hari' => 'required|numeric|min:0',
        'foto_barang'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $fotoPath = $pinjaman->foto_barang;

    if ($request->hasFile('foto_barang')) {
        $fotoPath = $request->file('foto_barang')->store('pinjaman', 'public');
    }

    $pinjaman->update([
        'nama_barang'    => $request->nama_barang,
        'stok'           => $request->stok,
        'harga'          => $request->harga,
        'harga_per_hari' => $request->harga_per_hari,
        'foto_barang'    => $fotoPath,
    ]);

    return redirect()->route('admin.pinjaman-aksesoris.index')
        ->with('success', 'Data pinjaman aksesoris berhasil diperbarui!');
}

public function pinjamanKurangiStok($id)
{
    $pinjaman = \App\Models\PinjamanAksesoris::findOrFail($id);

    if ($pinjaman->stok <= 0) {
        return redirect()->back()->with('error', 'Stok barang sudah habis!');
    }

    $pinjaman->stok = $pinjaman->stok - 1;
    $pinjaman->save();

    return redirect()->back()->with('success', 'Stok barang berhasil dikurangi!');
}
public function pinjamanUpdateStok(Request $request, $id)
{
    $request->validate([
        'stok' => 'required|integer|min:0',
    ]);

    $pinjaman = \App\Models\PinjamanAksesoris::findOrFail($id);
    $pinjaman->update([
        'stok' => $request->stok,
    ]);

    return redirect()->back()->with('success', 'Stok berhasil diperbarui!');
}
public function pinjamanDestroy($id)
{
    $pinjaman = \App\Models\PinjamanAksesoris::findOrFail($id);

    if ($pinjaman->foto_barang) {
        Storage::disk('public')->delete($pinjaman->foto_barang);
    }

    $pinjaman->delete();

    return redirect()->route('admin.pinjaman-aksesoris.index')
        ->with('success', 'Data pinjaman aksesoris berhasil dihapus!');
}

}