<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        // Cek jika user sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('success', 'Anda sudah login!');
        }

        return view('pages.auth.login');
    }

    /**
     * Menampilkan halaman registrasi
     */
    public function showRegister()
    {
        // Cek jika user sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('info', 'Anda sudah login!');
        }

        return view('pages.auth.register');
    }

    /**
     * Handle logika form login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 3 karakter',
        ]);

        // Cari user berdasarkan email SAJA (tanpa username)
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Login user menggunakan Auth::login()
            Auth::login($user);

            // Simpan informasi terakhir login ke session
            session(['last_login' => now()]);
            session(['user_name' => $user->name]);
            session(['user_email' => $user->email]);
            session(['user_role' => $user->role]);

            return redirect()->route('dashboard')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
        } else {
            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }
    }

    /**
     * Handle logika form register (CREATE User)
     */
    public function register(Request $request)
    {
        // Validasi custom untuk nama (tidak mengandung angka)
        Validator::extend('no_numbers', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/[0-9]/', $value);
        });

        // Validasi data - HAPUS VALIDASI UNTUK USERNAME
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|no_numbers',
            'email' => 'required|email|max:100|unique:users,email',
            // HAPUS username dari validasi karena kolom tidak ada di database
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/',
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 50 karakter',
            'name.no_numbers' => 'Nama tidak boleh mengandung angka',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 100 karakter',
            'email.unique' => 'Email sudah digunakan',
            // HAPUS pesan error untuk username
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 3 karakter',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf kapital',
            'password_confirmation.same' => 'Konfirmasi password tidak sesuai',
        ]);

        // Cek validasi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data ke database (CREATE User) - HAPUS username dari data yang disimpan
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                // JANGAN simpan username karena kolom tidak ada
                'password' => Hash::make($request->password),
                'role' => 'user', // Default role untuk user baru
            ]);

            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil! Silakan Login');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['registration_error' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Logout user menggunakan Auth::logout()
        Auth::logout();

        // Hapus semua session dan regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Hapus session yang dibuat manual
        session()->forget(['last_login', 'user_name', 'user_email', 'user_role']);

        return redirect()->route('login')
            ->with('success', 'Anda telah logout!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
