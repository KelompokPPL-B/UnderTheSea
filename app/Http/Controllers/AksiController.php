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

    // 🔥 INDEX (SEARCH + SORT + OPTIMIZED)
    public function index(Request $request)
    {
        // Validasi input search maksimal 50 karakter agar aman dari input berlebih
        $request->validate([
            'search' => 'nullable|string|max:50',
        ], [
            'search.max' => 'Teks pencarian kepanjangan, maksimal 50 karakter ya!', 
        ]);

        $sort = $request->query('sort', 'newest');
        $search = $request->query('search');

        $query = AksiPelestarian::query()
            ->select('id_aksi', 'judul_aksi', 'deskripsi', 'gambar', 'created_at');

        // 🔍 SEARCH (Tetap menggunakan prefix search yang optimal)
        if (!empty($search)) {
            $query->where('judul_aksi', 'like', "{$search}%");
        }

        // 🔽 SORT
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'popular') {
            $query->withCount('likes')->orderByDesc('likes_count');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // 📄 PAGINATION
        $aksi = $query->paginate(10)->appends($request->query());

        return view('aksi.index', compact('aksi', 'sort', 'search'));
    }

    public function create()
    {
        return view('aksi.create');
    }

    public function show($id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'aksi', $id);
        }

        return view('aksi.show', compact('aksi'));
    }

    public function edit($id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $aksi->created_by) {
            abort(403);
        }

        return view('aksi.edit', compact('aksi'));
    }

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

        return response()->json([
            'status' => 'success',
            'message' => 'Action updated successfully',
            'data' => $aksi,
        ]);
    }

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