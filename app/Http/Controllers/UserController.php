<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Calculate Stats
        $stats = [
            'total_users' => User::count(),
            'aktif' => User::where('activiti', 'Aktif')->count(),
            'tidak_aktif' => User::where('activiti', '!=', 'Aktif')->orWhereNull('activiti')->count(),
            'admin' => User::where('role', 'Admin')->count(),
        ];

        // Query with Filter & Search
        $query = User::query();
        
        if ($request->filled('activiti')) {
            $query->where('activiti', $request->activiti);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('username', 'LIKE', '%' . $request->search . '%');
            });
        }

        $data['dataUsers'] = $query->paginate(9)->withQueryString();
        $data['stats'] = $stats;
        
        return view('pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:20|unique:users,username',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:Admin,Warga,User', // Saya tambahkan 'User'
        ]);

        // Simpan data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Kita gunakan $dataUser agar sesuai dengan view edit.blade.php yang sudah diperbaiki
        $data['dataUser'] = User::findOrFail($id);
        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|string|max:20|unique:users,username,' . $id,
            'password' => 'nullable|string|confirmed',
            'role' => 'required|in:Admin,Warga,User', // Saya tambahkan 'User'
        ]);

        // Siapkan data untuk update
        $dataToUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Jika password diisi, hash password baru dan masukkan ke array data
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        // Lakukan update
        $user->update($dataToUpdate);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
