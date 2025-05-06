<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    // Menampilkan semua data masyarakat
    public function index()
    {
        $masyarakats = Masyarakat::all();
        return view('masyarakat.index', compact('masyarakats'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return view('masyarakat.create');
    }

    // Menyimpan data masyarakat baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'nomor_telpon' => 'required|string|max:15',
        ]);

        Masyarakat::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'nomor_telpon' => $request->nomor_telpon,
        ]);

        return redirect()->route('masyarakat.index')->with('success', 'Data masyarakat berhasil ditambahkan.');
    }

    // Menampilkan detail masyarakat tertentu
    public function show($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('masyarakat.show', compact('masyarakat'));
    }

    // Menampilkan form edit data
    public function edit($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('masyarakat.edit', compact('masyarakat'));
    }

    // Memperbarui data masyarakat
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'nomor_telpon' => 'required|string|max:15',
        ]);

        $masyarakat = Masyarakat::findOrFail($id);

        $masyarakat->update([
            'name' => $request->name,
            'password' => $request->password ? bcrypt($request->password) : $masyarakat->password,
            'nomor_telpon' => $request->nomor_telpon,
        ]);

        return redirect()->route('masyarakat.index')->with('success', 'Data masyarakat berhasil diperbarui.');
    }

    // Menghapus data masyarakat
    public function destroy($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->delete();

        return redirect()->route('masyarakat.index')->with('success', 'Data masyarakat berhasil dihapus.');
    }
}