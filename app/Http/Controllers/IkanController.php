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
        // Ambil parameter sorting, default ke 'newest'
        $sort          = $request->get('sort', 'newest');
        $filterHabitat = $request->get('habitat', '');
        $filterStatus  = $request->get('status', '');

        // Inisialisasi query model Ikan
        $dataIkan = Ikan::query();

        // Filter berdasarkan habitat
        if ($filterHabitat) {
            $dataIkan->where('habitat', $filterHabitat);
        }

        // Filter berdasarkan status konservasi
        if ($filterStatus) {
            $dataIkan->where('status_konservasi', $filterStatus);
        }

        // Tentukan urutan berdasarkan pilihan sort
        match ($sort) {
            'oldest'    => $dataIkan->orderBy('created_at', 'asc'),
            'name_asc'  => $dataIkan->orderBy('nama', 'asc'),
            'name_desc' => $dataIkan->orderBy('nama', 'desc'),
            default     => $dataIkan->orderByDesc('created_at'),
        };

        // Ambil data dengan pagination (sertakan query string agar pagination preserve filter)
        $ikan = $dataIkan->paginate(10)->withQueryString();

        // Ambil daftar unik untuk dropdown filter
        $habitatList = Ikan::select('habitat')
            ->whereNotNull('habitat')
            ->where('habitat', '!=', '')
            ->distinct()
            ->orderBy('habitat')
            ->pluck('habitat');

        $statusList = Ikan::select('status_konservasi')
            ->whereNotNull('status_konservasi')
            ->where('status_konservasi', '!=', '')
            ->distinct()
            ->orderBy('status_konservasi')
            ->pluck('status_konservasi');

        // Kirim ke view
        return view('ikan.index', [
            'ikan'          => $ikan,
            'sort'          => $sort,
            'filterHabitat' => $filterHabitat,
            'filterStatus'  => $filterStatus,
            'habitatList'   => $habitatList,
            'statusList'    => $statusList,
        ]);
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
            'nama'             => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'habitat'          => 'required|string|max:255',
            'karakteristik'    => 'required|string',
            'status_konservasi'=> 'required|string|max:100',
            'fakta_unik'       => 'required|string',
            'gambar'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama.required'             => 'Fish name is required.',
            'deskripsi.required'        => 'Description is required.',
            'habitat.required'          => 'Habitat is required.',
            'karakteristik.required'    => 'Characteristics are required.',
            'status_konservasi.required'=> 'Conservation status is required.',
            'fakta_unik.required'       => 'Unique fact is required.',
            'gambar.required'           => 'Image must be uploaded.',
            'gambar.image'              => 'The file must be an image.',
            'gambar.mimes'              => 'Image format must be JPG or PNG.',
            'gambar.max'                => 'Image size must not exceed 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('fish', 'public');
        }

        $validated['created_by'] = auth()->id();
        $ikan = Ikan::create($validated);

        return redirect()->route('ikan.index')->with('success', 'Fish created successfully!');
    }

    /**
     * Owner: Faiz
     * PBI-03: Manage Fish Content
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

        return redirect()->route('ikan.show', $ikan->id_ikan)->with('success', 'Fish updated successfully!');
    }

    /**
     * Owner: Faiz
     * PBI-09: Manage Fish Content
     * NOTE: Deletion is intentionally disabled. Fish data can only be edited.
     */
    public function destroy($id)
    {
        return response()->json([
            'status'  => 'error',
            'message' => 'Penghapusan data ikan tidak diizinkan. Data hanya dapat diedit.',
            'data'    => null,
        ], 403);
    }
}
