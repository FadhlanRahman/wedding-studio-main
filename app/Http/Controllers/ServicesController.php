<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    /**
     * =====================
     * FRONTEND (User)
     * =====================
     */
public function index()
{
    $services = Service::all();
    return view('services.index', compact('services'));
}

    /**
     * =====================
     * BACKEND (Admin)
     * =====================
     */
    public function adminIndex()
    {
        // Ambil data dengan pagination
        $services = Service::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'icon'        => 'nullable|string',
        ]);

        Service::create([
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'icon'        => $request->icon,
        ]);

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service berhasil ditambahkan!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'icon'        => 'nullable|string',
        ]);

        $service->update([
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'icon'        => $request->icon,
        ]);

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service berhasil dihapus!');
    }
}
