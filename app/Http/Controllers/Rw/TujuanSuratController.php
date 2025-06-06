<?php

namespace App\Http\Controllers\Rw;

use App\Models\TujuanSurat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TujuanSuratController extends Controller
{
    public function index(Request $request)
    {
        $profile_rw = Auth::guard('rw')->user()->profile_rw;
        $query = TujuanSurat::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama_tujuan', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_surat', 'like', '%' . $request->search . '%');
            });
        }

        $tujuanSurat = $query->get();

        return view('rw.tujuanSurat', compact('tujuanSurat', 'profile_rw'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tujuan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'nomor_surat' => 'required|string|max:100',
            'status_populer' => 'required|boolean',
        ]);

        TujuanSurat::create([
            'nama_tujuan' => $request->nama_tujuan,
            'deskripsi' => $request->deskripsi,
            'nomor_surat' => $request->nomor_surat,
            'status_populer' => $request->status_populer,
        ]);

        return redirect()->back()->with('success', 'Tujuan surat berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tujuanSurat = TujuanSurat::findOrFail($id);

        $request->validate([
            'nama_tujuan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'nomor_surat' => 'required|string|max:100',
        ]);

        $tujuanSurat->update($request->all());

        return redirect()->back()->with('success', 'Tujuan surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tujuanSurat = TujuanSurat::findOrFail($id);
        $tujuanSurat->delete();

        return redirect()->back()->with('success', 'Tujuan surat berhasil dihapus.');
    }
}
