<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendidikan;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tingkat = $request->input('tingkat');
        
        $pendidikan = Pendidikan::when($search, function ($query, $search) {
            return $query->where('nama_institusi', 'like', "%{$search}%")
                         ->orWhere('alamat', 'like', "%{$search}%")
                         ->orWhere('akreditasi', 'like', "%{$search}%");
        })
        ->when($tingkat, function ($query, $tingkat) {
            return $query->where('tingkat_pendidikan', $tingkat);
        })
        ->orderBy('tingkat_pendidikan')
        ->orderBy('nama_institusi')
        ->paginate(10);
        
        return view('components.pendidikan.index', compact('pendidikan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.pendidikan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_institusi' => 'required|string|max:255',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
            'tingkat_pendidikan' => 'required|string|max:50',
            'alamat' => 'required|string|max:500',
            'akreditasi' => 'nullable|string|max:10',
        ]);
        
        Pendidikan::create($validated);
        
        return redirect()->route('pendidikan.index')
                         ->with('success', 'Data pendidikan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tidak digunakan untuk sekarang
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pendidikan = Pendidikan::findOrFail($id);
        return view('components.pendidikan.edit', compact('pendidikan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pendidikan = Pendidikan::findOrFail($id);
        
        $validated = $request->validate([
            'nama_institusi' => 'required|string|max:255',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
            'tingkat_pendidikan' => 'required|string|max:50',
            'alamat' => 'required|string|max:500',
            'akreditasi' => 'nullable|string|max:10',
        ]);
        
        $pendidikan->update($validated);
        
        return redirect()->route('pendidikan.index')
                         ->with('success', 'Data pendidikan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendidikan = Pendidikan::findOrFail($id);
        $pendidikan->delete();
        
        return redirect()->route('pendidikan.index')
                         ->with('success', 'Data pendidikan berhasil dihapus.');
    }

    // untuk view user
    public function userView()
    {
        $pendidikan = Pendidikan::orderBy('tingkat_pendidikan')
                               ->orderBy('nama_institusi')
                               ->get();
                               
        // Hitung statistik
        $statistik = [
            'total' => $pendidikan->count(),
            'tk_paud' => $pendidikan->where('tingkat_pendidikan', 'TK/PAUD')->count(),
            'sd' => $pendidikan->where('tingkat_pendidikan', 'Sekolah Dasar')->count(),
            'smp' => $pendidikan->where('tingkat_pendidikan', 'SMP')->count(),
            'sma' => $pendidikan->whereIn('tingkat_pendidikan', ['SMA', 'SMK'])->count(),
            'pt' => $pendidikan->where('tingkat_pendidikan', 'Perguruan Tinggi')->count(),
        ];
        
        return view('layanan.pendidikan', compact('pendidikan', 'statistik'));
    }
}