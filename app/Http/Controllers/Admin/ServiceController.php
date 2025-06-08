<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $services = Layanan::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'harga_per_kg' => 'required|numeric|min:0',
            'estimasi_hari' => 'required|integer|min:1',
            // 'aktif' checkbox bisa nullable
            'aktif' => 'nullable',
        ]);

        $aktif = $request->has('aktif') ? true : false;

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'harga_per_kg' => $request->harga_per_kg,
            'estimasi_hari' => $request->estimasi_hari,
            'aktif' => $aktif,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function show(Layanan $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Layanan $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Layanan $service)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'harga_per_kg' => 'required|numeric|min:0',
            'estimasi_hari' => 'required|integer|min:1',
            'aktif' => 'nullable',
        ]);

        $aktif = $request->has('aktif') ? true : false;

        $service->update([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi' => $request->deskripsi,
            'harga_per_kg' => $request->harga_per_kg,
            'estimasi_hari' => $request->estimasi_hari,
            'aktif' => $aktif,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $service)
    {
        // Jika layanan memiliki relasi ke pesanan (jika ada)
        if (method_exists($service, 'orders') && $service->orders()->exists()) {
            return redirect()->route('admin.services.index')
                ->with('error', 'Layanan tidak dapat dihapus karena masih memiliki pesanan.');
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
