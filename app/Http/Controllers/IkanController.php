<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Illuminate\Http\Request;

class IkanController extends Controller
{
    public function index()
    {
        // Semua user lihat data yang sama
        $ikan = Ikan::all();

        return view('ikan.index', compact('ikan'));
    }

    public function create()
    {
        // Optional: kalau mau batasi hanya admin
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('ikan.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'nama'  => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
        ]);

        Ikan::create([
            'nama'  => $request->nama,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('ikan.index')
            ->with('success', 'Data ikan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $ikan = Ikan::findOrFail($id);

        return view('ikan.edit', compact('ikan'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'nama'  => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
        ]);

        $ikan = Ikan::findOrFail($id);

        $ikan->update($request->only('nama', 'jenis'));

        return redirect()->route('ikan.index')
            ->with('success', 'Data ikan berhasil diupdate.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $ikan = Ikan::findOrFail($id);

        $ikan->delete();

        return redirect()->route('ikan.index')
            ->with('success', 'Data ikan berhasil dihapus.');
    }
}