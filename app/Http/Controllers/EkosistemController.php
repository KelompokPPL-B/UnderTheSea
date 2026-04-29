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

    /**
     * Owner: Arvia
     * PBI-11: Manage Ecosystem Content
     * PBI-19: Pagination UI
     * PBI-21: Sort Options
     */
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

    /**
     * Owner: Arvia
     * PBI-15: Form Validation UI
     */
    public function create()
    {
        return view('ekosistem.create');
    }

    /**
     * Owner: Arvia
     * PBI-12: View Ecosystem Detail + Award Points
     */
    public function show($id)
    {
        $ekosistem = Ekosistem::findOrFail($id);

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'ekosistem', $id);
        }

        return view('ekosistem.show', compact('ekosistem'));
    }

    /**
     * Owner: Arvia
     * PBI-15: Form Validation UI
     */
    public function edit($id)
    {
        $ekosistem = Ekosistem::findOrFail($id);
        return view('ekosistem.edit', compact('ekosistem'));
    }

    /**
     * Owner: Arvia
     * PBI-11: Manage Ecosystem Content
     */
    public function store(Request $request)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $request->validate([
            'nama_ekosistem' => 'required|string|min:10|max:100',
            'deskripsi' =>'required|string|min:20',
            'lokasi' => 'required|string|min:10',
            'peran' => 'required|string|min:5',
            'ancaman' => 'required|string|min:5',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        }

        $validated['created_by'] = auth()->id();
        Ekosistem::create($validated);

        return redirect()->route('ekosistem.index')
            ->with('success', 'Ecosystem created successfully!');
    }

    /**
     * Owner: Arvia
     * PBI-11: Manage Ecosystem Content
     */
    public function update(Request $request, $id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ekosistem = Ekosistem::findOrFail($id);

        $validated = $request->validate([
            'nama_ekosistem' => 'required|string|min:10|max:100',
            'deskripsi' =>'required|string|min:20',
            'lokasi' => 'required|string|min:10',
            'peran' => 'required|string|min:5',
            'ancaman' => 'required|string|min:5',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
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

        return redirect()->route('ekosistem.index')
            ->with('success', 'Ecosystem deleted successfully!');
    }
}
