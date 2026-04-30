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
        $sort = $request->query('sort', 'newest');
        $query = Ekosistem::query();

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $ekosistem = $query->paginate(10);
        return view('ekosistem.index', compact('ekosistem', 'sort'));
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
        $validated = $request->validate([
            'nama_ekosistem'  => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'lokasi'          => 'nullable|string|max:255',
            'peran'           => 'nullable|string',
            'ancaman'         => 'nullable|string',
            'cara_menjaga'    => 'nullable|string',
            'larangan'        => 'nullable|string',
            'dampak_kerusakan'=> 'nullable|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        }

        $validated['created_by'] = auth()->id();
        $ekosistem = Ekosistem::create($validated);

        return redirect()->route('ekosistem.show', $ekosistem->id_ekosistem)
            ->with('success', 'Ecosystem created successfully!');
    }

    public function update(Request $request, $id)
    {
        $ekosistem = Ekosistem::findOrFail($id);

        $validated = $request->validate([
            'nama_ekosistem'  => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'lokasi'          => 'nullable|string|max:255',
            'peran'           => 'nullable|string',
            'ancaman'         => 'nullable|string',
            'cara_menjaga'    => 'nullable|string',
            'larangan'        => 'nullable|string',
            'dampak_kerusakan'=> 'nullable|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
        }

        $ekosistem->update($validated);

        return redirect()->route('ekosistem.show', $ekosistem->id_ekosistem)
            ->with('success', 'Ecosystem updated successfully!');
    }

    public function destroy($id)
    {
        $ekosistem = Ekosistem::findOrFail($id);

        if ($ekosistem->gambar) {
            Storage::disk('public')->delete($ekosistem->gambar);
        }

        $ekosistem->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Ecosystem deleted successfully',
            'data'    => null,
        ]);
    }
}