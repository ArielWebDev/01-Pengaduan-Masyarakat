<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    // Pastikan hanya masyarakat yang bisa akses controller ini
    public function __construct()
    {
        $this->middleware('auth:masyarakat');
    }

    // Menampilkan pengaduan saya (khusus masyarakat yang login)
    public function pengaduanSaya()
    {
        $pengaduanSaya = Pengaduan::where('masyarakat_id', Auth::guard('masyarakat')->id())
            ->with('tanggapan') // Ambil juga tanggapan jika ada
            ->orderBy('created_at', 'desc') // Urutkan dari terbaru ke terlama
            ->get();

        return view('pengaduan.saya', compact('pengaduanSaya'));
    }

    // Menampilkan semua pengaduan (untuk admin atau umum)
    public function semuaPengaduan()
    {
        $semuaPengaduan = Pengaduan::with('tanggapan') // Ambil juga tanggapan jika ada
            ->orderBy('created_at', 'desc') // Urutkan dari terbaru ke terlama
            ->get();

        return view('pengaduan.semua', compact('semuaPengaduan'));
    }

    // Menampilkan form buat pengaduan
    public function create()
    {
        return view('pengaduan.create');
    }

    // Menyimpan pengaduan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        // Simpan pengaduan ke database dengan guard masyarakat
        Pengaduan::create([
            'masyarakat_id' => Auth::guard('masyarakat')->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'status' => 'pending', // Default status awal
        ]);

        return redirect()->route('masyarakat.pengaduan.saya')->with('success', 'Pengaduan berhasil dikirim!');
    }
}