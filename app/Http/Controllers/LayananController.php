<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $data = Layanan::all();
        return view('layanan.index', compact('data'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak. Hanya Administrator yang dapat menambah layanan.');
        }
        return view('layanan.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga'        => 'required|integer|min:0',
        ]);

        Layanan::create($request->only('nama_layanan', 'harga'));
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak. Hanya Administrator yang dapat mengubah layanan.');
        }

        $data = Layanan::findOrFail($id);
        return view('layanan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga'        => 'required|integer|min:0',
        ]);

        $data = Layanan::findOrFail($id);
        $data->update($request->only('nama_layanan', 'harga'));

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diupdate.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        Layanan::destroy($id);
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}