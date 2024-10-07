<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba login menggunakan kredensial
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            $request->session()->regenerate();

            // Cek role dan redirect sesuai role
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->intended('/admin/home');
            } elseif ($user->role == 'guru') {
                return redirect()->intended('/guru/home');
            } elseif ($user->role == 'wali_kelas') {
                return redirect()->intended('/wali_kelas/home');
            }

            // Default redirect jika role tidak dikenali
            return redirect()->intended('/');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Kredensial tidak cocok.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
