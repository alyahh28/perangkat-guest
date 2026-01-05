<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Halaman Login
    public function index()
    {
        return view('pages.auth.login');
    }

    // Halaman Register
    public function showRegister()
    {
        return view('pages.auth.register');
    }

    // Proses Login
    public function login(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // 2. Cek User
        $user = User::where('username', $request->username)->first();

        // 3. Cek Password & Login
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            // 4. Redirect sesuai Role
            if ($user->role === 'Admin') {
                return redirect()->intended('/dashboard')
                    ->with('success', 'Halo Admin, ' . $user->name . '!');
            } elseif ($user->role === 'Warga') {
                return redirect()->intended('/dashboard')
                    ->with('success', 'Halo Warga, ' . $user->name . '!');
            } else {
                // User biasa
                return redirect()->to('/')
                    ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            }
        }

        // 5. Jika Gagal
        return redirect()->back()
            ->withErrors(['login_error' => 'Username atau Password salah.'])
            ->withInput($request->only('username'));
    }

    // Proses Register
    public function register(Request $request)
    {
        // 1. Validasi Custom (Tanpa Angka di Nama)
        Validator::extend('no_numbers', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/[0-9]/', $value);
        });

        // 2. Aturan Validasi
        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:50|no_numbers',
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|max:20|unique:users,username', // Pastikan kolom ini sudah ada di DB (Langkah 1)
            'role'     => 'required|in:User,Warga,Admin',
            'password' => 'required|min:3|regex:/[A-Z]/', // Minimal 3 char & ada huruf besar
            'password_confirmation' => 'required|same:password',
        ], [
            'name.no_numbers'  => 'Nama tidak boleh mengandung angka',
            'username.unique'  => 'Username sudah dipakai, pilih yang lain',
            'email.unique'     => 'Email sudah terdaftar',
            'password.regex'   => 'Password harus ada huruf besar',
            'password_confirmation.same' => 'Konfirmasi password beda',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 3. Simpan User
        try {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'username' => $request->username,
                'role'     => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')
                ->with('success', 'Registrasi Sukses! Silakan Login.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menyimpan data. Hubungi admin.'])
                ->withInput();
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }

    public function profile()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('pages.profile', compact('user'));
    }
}
