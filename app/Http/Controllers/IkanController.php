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
        // Validate according to spec
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'habitat' => 'required|string|max:255',
            'description' => 'required|string',
            'diet' => 'nullable|string',
            'size' => 'nullable|string|max:255',
            'conservation_status' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fish', 'public');
        }

        $ikan = new Ikan();
        $ikan->name = $validated['name'];
        $ikan->scientific_name = $validated['scientific_name'] ?? null;
        $ikan->habitat = $validated['habitat'];
        $ikan->description = $validated['description'];
        $ikan->diet = $validated['diet'] ?? null;
        $ikan->size = $validated['size'] ?? null;
        $ikan->conservation_status = $validated['conservation_status'] ?? null;
        $ikan->image = $imagePath;
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
            'name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'habitat' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'diet' => 'nullable|string',
            'size' => 'nullable|string|max:255',
            'conservation_status' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($ikan->image && \Storage::disk('public')->exists($ikan->image)) {
                \Storage::disk('public')->delete($ikan->image);
            }
            $ikan->image = $request->file('image')->store('fish', 'public');
        }

        $ikan->name = $validated['name'];
        $ikan->scientific_name = $validated['scientific_name'] ?? null;
        $ikan->habitat = $validated['habitat'] ?? null;
        $ikan->description = $validated['description'] ?? null;
        $ikan->diet = $validated['diet'] ?? null;
        $ikan->size = $validated['size'] ?? null;
        $ikan->conservation_status = $validated['conservation_status'] ?? null;
        $ikan->save();

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
        if ($ikan->image && \Storage::disk('public')->exists($ikan->image)) {
            \Storage::disk('public')->delete($ikan->image);
        }

        $ikan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Fish deleted successfully',
            'data' => null,
        ]);
    }
}
