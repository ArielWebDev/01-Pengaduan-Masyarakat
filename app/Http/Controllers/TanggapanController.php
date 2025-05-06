<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    // Menampilkan daftar semua pengaduan untuk admin
    public function index()
    {
        // Ambil semua pengaduan dan join dengan tanggapan (jika ada)
        $pengaduan = Pengaduan::with('tanggapan')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pengaduan.tanggapan', compact('pengaduan'));
    }

    // Menyimpan tanggapan pertama kali (ubah status ke "proses")
    public function store(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = 'diproses'; // Ubah status ke proses
        $pengaduan->save();

        Tanggapan::create([
            'pengaduan_id' => $id,
            'user_id' => Auth::id(), // Admin yang memberikan tanggapan
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan!');
    }

    // Mengubah tanggapan menjadi selesai
    public function update(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = 'selesai'; // Ubah status ke selesai
        $pengaduan->save();

        $tanggapan = Tanggapan::where('pengaduan_id', $id)->first();
        if ($tanggapan) {
            $tanggapan->update([
                'isi' => $request->isi,
            ]);
        }

        return redirect()->back()->with('success', 'Tanggapan berhasil diperbarui!');
    }
}