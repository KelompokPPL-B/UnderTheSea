<?php

namespace App\Http\Controllers;

use App\Models\Ekosistem;
use App\Services\PointsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkosistemController extends Controller
{
    private PointsService $pointsService;

    public function __construct(PointsService $pointsService)
    {
        $this->pointsService = $pointsService;
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'newest');
        $filterLokasi = $request->get('lokasi', '');

        $query = Ekosistem::query();

        if ($filterLokasi) {
            $query->where('lokasi', $filterLokasi);
        }

        match ($sort) {
            'oldest' => $query->orderBy('created_at', 'asc'),
            'name_asc' => $query->orderBy('nama_ekosistem', 'asc'),
            'name_desc' => $query->orderBy('nama_ekosistem', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
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
            'nama_ekosistem'   => 'required|string|min:5|max:50|unique:ekosistem,nama_ekosistem',
            'deskripsi'        => 'required|string|min:10|max:255',
            'lokasi'           => 'required|string|min:5|max:50',
            'peran'            => 'required|string|min:5|max:50',
            'ancaman'          => 'required|string|min:10|max:100',
            'cara_menjaga'     => 'nullable|string',
            'larangan'         => 'nullable|string',
            'dampak_kerusakan' => 'nullable|string',
            'gambar'           => 'required|image|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png|max:2048',
        ], [
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.image'    => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes'    => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        }

        $validated['created_by'] = auth()->id();

        Ekosistem::create($validated);

        return redirect()->route('ekosistem.index')
            ->with('success', 'Ecosystem created successfully!');
    }

    public function update(Request $request, $id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ekosistem = Ekosistem::findOrFail($id);

        $validated = $request->validate([
            'nama_ekosistem'   => 'required|string|min:5|max:50|unique:ekosistem,nama_ekosistem,' . $id . ',id_ekosistem',
            'deskripsi'        => 'required|string|min:10|max:255',
            'lokasi'           => 'required|string|min:5|max:50',
            'peran'            => 'required|string|min:5|max:50',
            'ancaman'          => 'required|string|min:10|max:100',
            'cara_menjaga'     => 'nullable|string',
            'larangan'         => 'nullable|string',
            'dampak_kerusakan' => 'nullable|string',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            if ($ekosistem->gambar) {
                Storage::disk('public')->delete($ekosistem->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        } else {
            unset($validated['gambar']);
        }

        $ekosistem->update($validated);

        return redirect()->route('ekosistem.show', $id)
            ->with('success', 'Ecosystem updated successfully!');
    }

    public function destroy($id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ekosistem = Ekosistem::findOrFail($id);

        if ($ekosistem->gambar) {
            Storage::disk('public')->delete($ekosistem->gambar);
        }

        $ekosistem->delete();

        return redirect()->route('ekosistem.index')
            ->with('success', 'Ecosystem deleted successfully!');
    }
}