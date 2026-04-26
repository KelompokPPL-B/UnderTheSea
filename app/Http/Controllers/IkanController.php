<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Services\PointsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IkanController extends Controller
{
    private PointsService $pointsService;

    public function __construct(PointsService $pointsService)
    {
        $this->pointsService = $pointsService;
    }

    public function index(Request $request)
    {
        $sort = $request->query('sort', 'newest');
        $query = Ikan::query();

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $ikan = $query->paginate(10);
        return view('ikan.index', compact('ikan', 'sort'));
    }

    public function create()
    {
        return view('ikan.create');
    }

    public function show($id)
    {
        $ikan = Ikan::findOrFail($id);

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'ikan', $id);
        }

        return view('ikan.show', compact('ikan'));
    }

    public function edit($id)
    {
        $ikan = Ikan::findOrFail($id);
        return view('ikan.edit', compact('ikan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'habitat'           => 'nullable|string|max:255',
            'karakteristik'     => 'nullable|string',
            'status_konservasi' => 'nullable|string|max:100',
            'fakta_unik'        => 'nullable|string',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('fish', 'public');
        }

        $validated['created_by'] = auth()->id();
        $ikan = Ikan::create($validated);

        return redirect()->route('ikan.show', $ikan->id_ikan)
            ->with('success', 'Fish species created successfully!');
    }

    public function update(Request $request, $id)
    {
        $ikan = Ikan::findOrFail($id);

        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'habitat'           => 'nullable|string|max:255',
            'karakteristik'     => 'nullable|string',
            'status_konservasi' => 'nullable|string|max:100',
            'fakta_unik'        => 'nullable|string',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            if ($ikan->gambar) {
                Storage::disk('public')->delete($ikan->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('fish', 'public');
        }

        $ikan->update($validated);

        return redirect()->route('ikan.show', $ikan->id_ikan)
            ->with('success', 'Fish species updated successfully!');
    }

    public function destroy($id)
    {
        $ikan = Ikan::findOrFail($id);

        if ($ikan->gambar) {
            Storage::disk('public')->delete($ikan->gambar);
        }

        $ikan->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Fish deleted successfully',
            'data'    => null,
        ]);
    }
}