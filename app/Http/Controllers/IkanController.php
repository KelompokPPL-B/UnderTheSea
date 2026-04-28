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
     */
    public function index(Request $request)
    {
        // Support sorting: 'newest' (default) or 'oldest'
        $sort = $request->query('sort', 'newest');

        $query = Ikan::query();

        // Sorting options: newest, oldest, name_asc, name_desc
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'name_asc') {
            $query->orderBy('nama', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('nama', 'desc');
        } else {
            // default newest
            $sort = 'newest';
            $query->orderBy('created_at', 'desc');
        }

        $ikan = $query->get();

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

        // Accept both English and Indonesian field names from forms
        $validated = $request->validate([
            'name' => 'required_without:nama|string|max:255',
            'nama' => 'required_without:name|string|max:255',
            'description' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $name = $request->input('name') ?? $request->input('nama');
        $description = $request->input('description') ?? $request->input('deskripsi');

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fish', 'public');
        } elseif ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('fish', 'public');
        }

        // Use English attributes (Ikan model maps them to DB columns)
        $ikan = new Ikan([
            'name' => $name,
            'description' => $description,
            'image' => $imagePath,
        ]);

        $ikan->created_by = auth()->id();
        $ikan->save();

        return redirect()->route('ikan.index');
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
