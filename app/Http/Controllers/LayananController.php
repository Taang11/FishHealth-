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
            'subtype'      => 'required|in:teknisi,dokter',
        ]);

        Layanan::create($request->only('nama_layanan', 'harga', 'subtype'));
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
            'subtype'      => 'required|in:teknisi,dokter',
        ]);

        $data = Layanan::findOrFail($id);
        $data->update($request->only('nama_layanan', 'harga', 'subtype'));

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

    /**
     * API endpoint: return layanan filtered by subtype (JSON)
     * GET /api/layanan-by-subtype?subtype=teknisi|dokter
     */
    public function bySubtype(Request $request)
    {
        $subtype = $request->query('subtype', 'teknisi');

        if (!in_array($subtype, ['teknisi', 'dokter'])) {
            return response()->json(['error' => 'Invalid subtype'], 422);
        }

        $layanan = Layanan::forSubtype($subtype)
            ->select('layanan_id', 'nama_layanan', 'harga')
            ->orderBy('nama_layanan')
            ->get();

        return response()->json($layanan);
    }
}