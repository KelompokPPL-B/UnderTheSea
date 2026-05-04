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
        $validated = $request->validate([
            'nama_ekosistem' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'peran' => 'nullable|string',
            'karakteristik' => 'nullable|string',
            'manfaat' => 'nullable|string',
            'ancaman' => 'nullable|string',
            'cara_pelestarian' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,jfif|max:2048',
        ], [
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau JFIF.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        }

        $validated['created_by'] = auth()->id();
        $ekosistem = Ekosistem::create($validated);

        return redirect()->route('ekosistem.index')->with('success', 'Ecosystem created successfully');
    }

    /**
     * Owner: Arvia
     * PBI-11: Manage Ecosystem Content
     */
    public function update(Request $request, $id)
    {
        $ekosistem = Ekosistem::findOrFail($id);
        $validated = $request->validate([
            'nama_ekosistem' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'peran' => 'required|string',
            'ancaman' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,jfif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ekosistem', 'public');
        }

        $ekosistem->update($validated);

        return redirect()->route('ekosistem.index')
            ->with('success', 'Admin berhasil melakukan update data ekosistem.');
    }

    /**
     * Owner: Arvia
     * PBI-11: Manage Ecosystem Content
     */
    public function destroy($id)
    {
        $ekosistem = Ekosistem::findOrFail($id);
        $ekosistem->delete();

        return redirect()->route('ekosistem.index')->with('success', 'Ecosystem deleted successfully');
    }
}
