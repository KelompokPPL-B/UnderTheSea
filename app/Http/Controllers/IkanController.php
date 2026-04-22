<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Services\PointsService;
use Illuminate\Http\Request;

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
        $search = $request->query('search');

        $query = Ikan::query();

        // 🔍 SEARCH (optimized)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('habitat', 'like', "%{$search}%");
                  // ❌ deskripsi gak dipakai karena TEXT (biar cepat)
            });
        }

        // 🔽 SORT
        $query->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc');

        // 📄 PAGINATION
        $ikan = $query->paginate(10)->appends($request->query());

        return view('ikan.index', compact('ikan', 'sort', 'search'));
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
        $this->authorize('admin');

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'habitat' => 'nullable|string|max:255',
            'karakteristik' => 'nullable|string',
            'status_konservasi' => 'nullable|string|max:100',
            'fakta_unik' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('fish', 'public');
        }

        $validated['created_by'] = auth()->id();

        $ikan = Ikan::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Fish created successfully',
            'data' => $ikan,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin');

        $ikan = Ikan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'habitat' => 'nullable|string|max:255',
            'karakteristik' => 'nullable|string',
            'status_konservasi' => 'nullable|string|max:100',
            'fakta_unik' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('fish', 'public');
        }

        $ikan->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Fish updated successfully',
            'data' => $ikan,
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('admin');

        $ikan = Ikan::findOrFail($id);
        $ikan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Fish deleted successfully',
            'data' => null,
        ]);
    }
}