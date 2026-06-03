<?php

namespace App\Http\Controllers;

use App\Models\Ekosistem;
use App\Services\PointsService;
use Illuminate\Http\Request;

class EkosistemController extends Controller
{
    private PointsService $pointsService;

    public function __construct(PointsService $pointsService)
    {
        $this->pointsService = $pointsService;
    }

    public function index(Request $request)
    {
        $sort         = $request->get('sort', 'newest');
        $filterLokasi = $request->get('lokasi', '');

        $query = Ekosistem::query();

        if ($filterLokasi) {
            $query->where('lokasi', $filterLokasi);
        }

        match ($sort) {
            'oldest'    => $query->orderBy('created_at', 'asc'),
            'name_asc'  => $query->orderBy('nama_ekosistem', 'asc'),
            'name_desc' => $query->orderBy('nama_ekosistem', 'desc'),
            default     => $query->orderBy('created_at', 'desc'),
        };

        $ekosistem = $query->paginate(10)->withQueryString();

        $lokasiList = Ekosistem::select('lokasi')
            ->whereNotNull('lokasi')
            ->where('lokasi', '!=', '')
            ->distinct()
            ->orderBy('lokasi')
            ->pluck('lokasi');

        return view('ekosistem.index', compact('ekosistem', 'sort', 'filterLokasi', 'lokasiList'));
    }

    public function create()
    {
        return view('ekosistem.create');
    }

    public function show($id)
    {
        $ekosistem = Ekosistem::findOrFail($id);

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'ekosistem', $id);
        }

        return view('ekosistem.show', compact('ekosistem'));
    }

    public function edit($id)
    {
        $ekosistem = Ekosistem::findOrFail($id);
        return view('ekosistem.edit', compact('ekosistem'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $request->validate([
            'nama_ekosistem' => 'required|string|min:5|max:50|unique:ekosistem,nama_ekosistem',
            'deskripsi' => 'required|string|min:10|max:255',
            'lokasi' => 'required|string|min:5|max:50',
            'peran' => 'required|string|min:5|max:50',
            'karakteristik' => 'nullable|string',
            'manfaat' => 'nullable|string',
            'ancaman' => 'required|string|min:10|max:100',
            'cara_pelestarian' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,jfif|max:2048',
        ], [
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau JFIF.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        }

        $validated['created_by'] = auth()->id();
        Ekosistem::create($validated);

        return redirect()->route('ekosistem.index')->with('success', 'Ecosystem created successfully!');
    }

    public function update(Request $request, $id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);
        $ekosistem = Ekosistem::findOrFail($id);
        $validated = $request->validate([
            'nama_ekosistem' => 'required|string|min:5|max:50|unique:ekosistem,nama_ekosistem,'.$id.',id_ekosistem',
            'deskripsi' => 'required|string|min:10|max:255',
            'lokasi' => 'required|string|min:5|max:50',
            'peran' => 'required|string|min:5|max:50',
            'karakteristik' => 'nullable|string',
            'manfaat' => 'nullable|string',
            'ancaman' => 'required|string|min:10|max:100',
            'cara_pelestarian' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,jfif|max:2048',
        ]);


        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        } else {
            unset($validated['gambar']); // pakai gambar lama
        }


        $ekosistem->update($validated);

        return redirect()->route('ekosistem.show', $id)
            ->with('success', 'Ecosystem updated successfully!');
    }

    /**
     * Owner: Arvia
     * PBI-11: Manage Ecosystem Content
     */
    public function destroy($id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);
        $ekosistem = Ekosistem::findOrFail($id);
        $ekosistem->delete();

        return redirect()->route('ekosistem.index')->with('success', 'Ecosystem deleted successfully!');
    }
}
