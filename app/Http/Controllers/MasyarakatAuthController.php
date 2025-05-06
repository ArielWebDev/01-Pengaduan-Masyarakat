<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Hash;

class MasyarakatAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.masyarakat-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_telpon' => 'required|string|max:15|unique:masyarakats',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $masyarakat = Masyarakat::create([
            'name' => $request->name,
            'nomor_telpon' => $request->nomor_telepon,
            'password' => Hash::make($request->password), // Hashing password dengan Bcrypt
        ]);

        Auth::guard('masyarakat')->login($masyarakat);

        return redirect()->route('masyarakat.dashboard')->with('success', 'Registrasi berhasil!');
    }

    public function showLoginForm()
    {
        return view('auth.masyarakat-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
        // dd($request->all());
        
        $masyarakat = Masyarakat::where('name', $request->name)->first();

        if ($masyarakat && Hash::check($request->password, $masyarakat->password)) {
            Auth::guard('masyarakat')->login($masyarakat);
            return redirect()->route('masyarakat.dashboard');
        }

        return back()->withErrors(['login' => 'Nama atau password salah']);
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();
        return redirect()->route('frontsite.index')->with('success', 'Logout berhasil');
    }
}