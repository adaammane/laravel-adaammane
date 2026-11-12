<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // <-- WAJIB DITAMBAHKAN
use Illuminate\Support\Facades\Hash; // <-- WAJIB DITAMBAHKAN

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataUser = User::all();
        return view('admin.user.index', compact('dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan halaman form tambah user
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Enkripsi password
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'Data user berhasil ditambahkan.');
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
        $dataUser = User::findOrFail($id);
        return view('admin.user.edit', compact('dataUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed', // Nullable artinya boleh kosong jika tidak ingin ganti password
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Jika form password diisi, maka update passwordnya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Data user gagal dihapus.');
        }
    }
}