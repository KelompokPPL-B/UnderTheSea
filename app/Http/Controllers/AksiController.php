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
     * Owner: Arvia
     * PBI-13: Manage Action Content
     * PBI-19: Pagination UI
     * PBI-21: Sort Options
     * PBI-22: Filter Options
     */
    public function index(Request $request)
    {
        $sort       = $request->get('sort', 'newest');
        $filterTahun = $request->get('tahun', '');

        $query = AksiPelestarian::query();

        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        match ($sort) {
            'oldest'     => $query->orderBy('created_at', 'asc'),
            'title_asc'  => $query->orderBy('judul_aksi', 'asc'),
            'title_desc' => $query->orderBy('judul_aksi', 'desc'),
            default      => $query->orderBy('created_at', 'desc'),
        };

        $aksi = $query->paginate(10)->withQueryString();

        $tahunList = AksiPelestarian::selectRaw('YEAR(created_at) as tahun')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('aksi.index', compact('aksi', 'sort', 'filterTahun', 'tahunList'));
    }

    /**
     * Owner: Arvia
     * PBI-15: Form Validation UI
     */
    public function create()
    {
        return view('aksi.create');
    }

    /**
     * Owner: Arvia
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
     * Owner: Arvia
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
     * Owner: Arvia
     * PBI-13: Manage Action Content
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_aksi'     => 'required|string|min:5|max:50|unique:aksi_pelestarian,judul_aksi',
            'deskripsi'      => 'required|string|min:10|max:255',
            'manfaat'        => 'required|string|min:10|max:100',
            'cara_melakukan' => 'required|string|min:10|max:255',
            'gambar'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['judul_aksi']     = SanitizationService::sanitize($validated['judul_aksi']);
        $validated['deskripsi']      = SanitizationService::sanitize($validated['deskripsi']);
        $validated['manfaat']        = SanitizationService::sanitize($validated['manfaat']);
        $validated['cara_melakukan'] = SanitizationService::sanitize($validated['cara_melakukan']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('action', 'public');
        }

        $validated['created_by']        = auth()->id();
        $validated['is_user_generated'] = !auth()->user()->isAdmin();

        $aksi = AksiPelestarian::create($validated);

        $this->pointsService->awardPointsForAction(auth()->id(), $aksi->id_aksi);

        return redirect()->route('aksi.show', $aksi->id_aksi)
            ->with('success', 'Conservation action created successfully!');
    }

    /**
     * Owner: Arvia
     * PBI-13: Manage Action Content
     */
    public function update(Request $request, $id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $aksi->created_by) {
            abort(403);
        }

        $validated = $request->validate([
            'judul_aksi'     => 'required|string|min:5|max:50|unique:aksi_pelestarian,judul_aksi,'.$id.',id_aksi',
            'deskripsi'      => 'required|string|min:10|max:255',
            'manfaat'        => 'required|string|min:10|max:100',
            'cara_melakukan' => 'required|string|min:10|max:255',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['judul_aksi']     = SanitizationService::sanitize($validated['judul_aksi']);
        $validated['deskripsi']      = SanitizationService::sanitize($validated['deskripsi']);
        $validated['manfaat']        = SanitizationService::sanitize($validated['manfaat']);
        $validated['cara_melakukan'] = SanitizationService::sanitize($validated['cara_melakukan']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('action', 'public');
        } else {
            unset($validated['gambar']);
        }

        $aksi->update($validated);

        return redirect()->route('aksi.show', $id)
            ->with('success', 'Conservation action updated successfully!');
    }

    /**
     * Owner: Arvia
     * PBI-13: Manage Action Content
     */
    public function destroy($id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $aksi->created_by) {
            abort(403);
        }

        $aksi->delete();

        return redirect()->route('aksi.index')
            ->with('success', 'Conservation action deleted successfully!');
    }
}