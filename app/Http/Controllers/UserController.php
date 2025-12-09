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
        // Cek jika user belum login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $data['dataUsers'] = User::paginate(10);
        $filterableColumns = ['Status'];
        $searchTableColumns = ['first_name'];
        return view('pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cek jika user belum login
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:20|unique:users,username',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:Admin,Warga',
        ]);

        // Di method store (Simpan data)
User::create([
    'name' => $request->name,
    'email' => $request->email,
    'username' => $request->username,
    'password' => Hash::make($request->password),
    'role' => $request->role, // Tambahkan baris ini
]);

// Di method update (Edit data)
$dataToUpdate = [
    'name' => $request->name,
    'email' => $request->email,
    'username' => $request->username,
    'role' => $request->role, // Tambahkan baris ini
];

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function show($id)
{
    // Cari user berdasarkan ID, jika tidak ketemu akan error 404
    $user = \App\Models\User::findOrFail($id);

    // Kembalikan ke view show dengan membawa data $user
    return view('pages.user.show', compact('user'));
}

    public function edit(string $id)
    {
        // Cek jika user belum login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $data['dataUser'] = User::findOrFail($id);
        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|string|max:20|unique:users,username,' . $id,
            'password' => 'nullable|string|confirmed',
            'role' => 'required|in:Admin,Warga',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

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
