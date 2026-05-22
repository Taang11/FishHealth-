<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeknisiController extends Controller
{
    public function index()
    {
        $data = Teknisi::with('user')->get();
        return view('teknisi.index', compact('data'));
    }

    public function create()
    {
        return view('teknisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'no_hp'    => 'required|string|max:20',
            'subtype'  => 'required|in:teknisi,dokter',
            'alamat'   => 'required|string',
        ]);

        // Buat user baru untuk teknisi
        $user = User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'teknisi',
        ]);

        $data = $request->only('nama', 'subtype', 'no_hp', 'alamat', 'lat', 'lng');
        $data['user_id'] = $user->id;

        Teknisi::create($data);

        return redirect()->route('teknisi.index')->with('success', 'Teknisi berhasil ditambahkan dengan akun login.');
    }

    public function edit($id)
    {
        $data = Teknisi::with('user')->findOrFail($id);
        return view('teknisi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Teknisi::findOrFail($id);

        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $data->user_id,
            'password' => 'nullable|string|min:8',
            'no_hp'    => 'required|string|max:20',
            'subtype'  => 'required|in:teknisi,dokter',
            'alamat'   => 'required|string',
        ]);

        // Update user
        if ($data->user) {
            $userUpdate = [
                'name'  => $request->nama,
                'email' => $request->email,
            ];
            if ($request->filled('password')) {
                $userUpdate['password'] = Hash::make($request->password);
            }
            $data->user->update($userUpdate);
        }

        $data->update($request->only('nama', 'subtype', 'no_hp', 'alamat', 'lat', 'lng'));

        return redirect()->route('teknisi.index')->with('success', 'Data teknisi berhasil diupdate.');
    }

    public function destroy($id)
    {
        Teknisi::destroy($id);
        return redirect()->route('teknisi.index')->with('success', 'Teknisi berhasil dihapus.');
    }
}