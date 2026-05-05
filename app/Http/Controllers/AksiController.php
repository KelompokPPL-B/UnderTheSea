<?php

namespace App\Http\Controllers;

use App\Models\AksiPelestarian;
use App\Services\PointsService;
use App\Services\SanitizationService;
use Illuminate\Http\Request;

class AksiController extends Controller
{
    private PointsService $pointsService;

    public function __construct(PointsService $pointsService)
    {
        $this->pointsService = $pointsService;
    }

    /**
     * Owner: Mutiara
     * PBI-13: Manage Action Content
     * PBI-19: Pagination UI
     * PBI-21: Sort Options
     */
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'newest');
        $query = AksiPelestarian::query();

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'popular') {
            $query->withCount('likes')->orderByDesc('likes_count');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $aksi = $query->paginate(10);
        return view('aksi.index', compact('aksi', 'sort'));
    }

    /**
     * Owner: Mutiara
     * PBI-15: Form Validation UI
     */
    public function create()
    {
        return view('aksi.create');
    }

    /**
     * Owner: Mutiara
     * PBI-13: Manage Action Content
     */
    public function show($id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'aksi', $id);
        }

        return view('aksi.show', compact('aksi'));
    }

    /**
     * Owner: Mutiara
     * PBI-15: Form Validation UI
     */
    public function edit($id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $aksi->created_by) {
            abort(403);
        }

        return view('aksi.edit', compact('aksi'));
    }

    /**
     * Owner: Mutiara
     * PBI-14: User Contribution + Award Points
     * PBI-18: Input Sanitization & Escaping
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_aksi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'manfaat' => 'nullable|string',
            'cara_melakukan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['judul_aksi'] = SanitizationService::sanitize($validated['judul_aksi']);
        $validated['deskripsi'] = SanitizationService::sanitize($validated['deskripsi']);
        $validated['manfaat'] = SanitizationService::sanitize($validated['manfaat']);
        $validated['cara_melakukan'] = SanitizationService::sanitize($validated['cara_melakukan']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('action', 'public');
        }

        $validated['created_by'] = auth()->id();
        $validated['is_user_generated'] = !auth()->user()->isAdmin();

        $aksi = AksiPelestarian::create($validated);

        $this->pointsService->awardPointsForAction(auth()->id(), $aksi->id_aksi);

        return response()->json([
            'status' => 'success',
            'message' => 'Action created successfully',
            'data' => $aksi,
        ], 201);
    }

    /**
     * Owner: Mutiara
     * PBI-13: Manage Action Content
     * PBI-18: Input Sanitization & Escaping
     */
    public function update(Request $request, $id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $aksi->created_by) {
            abort(403);
        }

        $validated = $request->validate([
            'judul_aksi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'manfaat' => 'nullable|string',
            'cara_melakukan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['judul_aksi'] = SanitizationService::sanitize($validated['judul_aksi']);
        $validated['deskripsi'] = SanitizationService::sanitize($validated['deskripsi']);
        $validated['manfaat'] = SanitizationService::sanitize($validated['manfaat']);
        $validated['cara_melakukan'] = SanitizationService::sanitize($validated['cara_melakukan']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('action', 'public');
        }

        $aksi->update($validated);

        return redirect()->route('aksi.show', $aksi->id_aksi)->with('success', 'Action updated successfully!');
    }

    /**
     * Owner: Mutiara
     * PBI-13: Manage Action Content
     */
    public function destroy($id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $aksi->created_by) {
            abort(403);
        }

        $aksi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Action deleted successfully',
            'data' => null,
        ]);
    }
}
