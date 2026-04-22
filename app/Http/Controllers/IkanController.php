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

    /**
     * Owner: Faiz
     * PBI-09: Manage Fish Content
     * PBI-19: Pagination UI
     * PBI-21: Sort Options
     */
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

    /**
     * Owner: Faiz
     * PBI-15: Form Validation UI
     */
    public function create()
    {
        return view('ikan.create');
    }

    /**
     * Owner: Faiz
     * PBI-10: View Fish Detail + Award Points
     */
    public function show($id)
    {
        $ikan = Ikan::findOrFail($id);

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'ikan', $id);
        }

        return view('ikan.show', compact('ikan'));
    }

    /**
     * Owner: Faiz
     * PBI-15: Form Validation UI
     */
    public function edit($id)
    {
        $ikan = Ikan::findOrFail($id);
        return view('ikan.edit', compact('ikan'));
    }

    /**
     * Owner: Faiz
     * PBI-09: Manage Fish Content
     */
    public function store(Request $request)
    {
        $this->authorize('admin');

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

        return response()->json([
            'status'  => 'success',
            'message' => 'Fish created successfully',
            'data'    => $ikan,
        ], 201);
    }

    /**
     * Owner: Faiz
     * PBI-09: Manage Fish Content
     */
    public function update(Request $request, $id)
    {
        $this->authorize('admin');

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

        return response()->json([
            'status'  => 'success',
            'message' => 'Fish updated successfully',
            'data'    => $ikan,
        ]);
    }

    /**
     * Owner: Faiz
     * PBI-09: Manage Fish Content
     */
    public function destroy($id)
    {
        $this->authorize('admin');

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