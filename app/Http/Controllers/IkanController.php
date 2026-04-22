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

    /**
     * Owner: Faiz
     * PBI-09: Manage Fish Content
     * PBI-19: Pagination UI
     * PBI-21: Sort Options
     * 🔥 UPDATED: Added Search Feature
     */
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'newest');
        $search = $request->query('search'); // 🔍 search input

        $query = Ikan::query();

        // 🔍 SEARCH LOGIC
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('habitat', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // SORT LOGIC
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $ikan = $query->paginate(10)->appends($request->query());

        return view('ikan.index', compact('ikan', 'sort', 'search'));
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

    /**
     * Owner: Faiz
     * PBI-09: Manage Fish Content
     */
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

    /**
     * Owner: Faiz
     * PBI-09: Manage Fish Content
     */
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