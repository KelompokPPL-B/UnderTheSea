<?php

namespace App\Http\Controllers;

use App\Models\AksiPelestarian;
use App\Models\AksiTandai;
use App\Models\AksiFeedback;
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
     * Owner: Arvia / Mutiara
     * PBI-13: Manage Action Content
     * PBI-19: Pagination UI
     * PBI-21: Sort Options
     * PBI-22: Filter Options
     *
     * Search + Sort + Filter Tahun + Pagination
     */
    public function index(Request $request)
    {
        // Validasi input search maksimal 100 karakter dan tidak mengandung karakter spesial
        $request->validate([
            'search' => 'nullable|string|max:100|regex:/^[a-zA-Z0-9\s]*$/',
        ], [
            'search.max' => 'Kata kunci pencarian tidak boleh melebihi 100 karakter.',
            'search.regex' => 'Kata kunci pencarian tidak boleh mengandung karakter spesial.',
        ]);

        $sort = $request->get('sort', 'newest');
        $search = $request->get('search', '');
        $filterTahun = $request->get('tahun', '');

        $query = AksiPelestarian::query();

        // Search berdasarkan judul aksi
        if (!empty($search)) {
            $query->where('judul_aksi', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan tahun created_at
        if (!empty($filterTahun)) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Sort
        match ($sort) {
            'oldest'     => $query->orderBy('created_at', 'asc'),
            'popular'    => $query->withCount('likes')->orderByDesc('likes_count'),
            'title_asc'  => $query->orderBy('judul_aksi', 'asc'),
            'title_desc' => $query->orderBy('judul_aksi', 'desc'),
            default      => $query->orderBy('created_at', 'desc'),
        };

        // Pagination
        $aksi = $query->paginate(10)->withQueryString();

        // List tahun untuk filter
        $tahunList = AksiPelestarian::selectRaw('YEAR(created_at) as tahun')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('aksi.index', compact(
            'aksi',
            'sort',
            'search',
            'filterTahun',
            'tahunList'
        ));
    }

    /**
     * Owner: Arvia / Mutiara
     * PBI-15: Form Validation UI
     */
    public function create()
    {
        return view('aksi.create');
    }

    /**
     * Owner: Arvia / Mutiara / Diperbarui oleh Grace
     * PBI-13: Manage Action Content
     */
    public function show($id)
    {
        $aksi = AksiPelestarian::with('feedback')->findOrFail($id);

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'aksi', $id);
        }

        return view('aksi.show', compact('aksi'));
    }

    /**
     * Owner: Arvia / Mutiara
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
     * Owner: Arvia / Mutiara
     * PBI-13: Manage Action Content
     */
    public function store(Request $request)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

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

        $validated['created_by'] = auth()->id();
        $validated['is_user_generated'] = !auth()->user()->isAdmin();

        $aksi = AksiPelestarian::create($validated);

        $this->pointsService->awardPointsForAction(auth()->id(), $aksi->id_aksi);

        return redirect()->route('aksi.show', $aksi->id_aksi)
            ->with('success', 'Conservation action created successfully!');
    }

    /**
     * Owner: Arvia / Mutiara
     * PBI-13: Manage Action Content
     */
    public function update(Request $request, $id)
    {
        $aksi = AksiPelestarian::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $aksi->created_by) {
            abort(403);
        }

        $validated = $request->validate([
            'judul_aksi'     => 'required|string|min:5|max:50|unique:aksi_pelestarian,judul_aksi,' . $id . ',id_aksi',
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
     * Owner: Arvia / Mutiara
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

    /**
     * Owner: Grace Magaretha Sirait
     * PBI-26: Menandai aksi pelestarian selesai
     */
    public function tandai(Request $request, $id)
    {
        AksiPelestarian::findOrFail($id);

        $validated = $request->validate([
            'nama_peserta' => 'required|string|max:100',
        ], [
            'nama_peserta.required' => 'Name is required.',
            'nama_peserta.max'      => 'Name must not exceed 100 characters.',
        ]);

        $sessionId = session()->getId();

        $sudahTandai = AksiTandai::where('aksi_id', $id)
            ->where('session_id', $sessionId)
            ->exists();

        if ($sudahTandai) {
            return redirect()->route('aksi.show', $id);
        }

        AksiTandai::create([
            'aksi_id'      => $id,
            'nama_peserta' => $validated['nama_peserta'],
            'session_id'   => $sessionId,
        ]);

        session()->put("tandai_aksi_{$id}", true);
        session()->put("tandai_aksi_{$id}_nama", $validated['nama_peserta']);

        return redirect()->route('aksi.show', $id);
    }

    /**
     * Owner: Grace Magaretha Sirait
     * PBI-26: Membatalkan penandaan aksi
     */
    public function batalTandai($id)
    {
        AksiPelestarian::findOrFail($id);

        $sessionId = session()->getId();

        AksiTandai::where('aksi_id', $id)
            ->where('session_id', $sessionId)
            ->delete();

        AksiFeedback::where('aksi_id', $id)
            ->where('session_id', $sessionId)
            ->delete();

        session()->forget("tandai_aksi_{$id}");
        session()->forget("tandai_aksi_{$id}_nama");

        return redirect()->route('aksi.show', $id);
    }

    /**
     * Owner: Grace Magaretha Sirait
     * PBI-26: Menyimpan ulasan feedback dari peserta yang telah menandai aksi
     */
    public function storeFeedback(Request $request, $id)
    {
        AksiPelestarian::findOrFail($id);

        $sessionId = session()->getId();

        $sudahTandai = AksiTandai::where('aksi_id', $id)
            ->where('session_id', $sessionId)
            ->exists();

        if (!$sudahTandai) {
            return redirect()->route('aksi.show', $id);
        }

        $validated = $request->validate([
            'nama_peserta' => 'required|string|max:100',
            'komentar'     => 'required|string|max:2000',
        ]);

        $validated['komentar'] = SanitizationService::sanitize($validated['komentar']);

        $sudahFeedback = AksiFeedback::where('aksi_id', $id)
            ->where('session_id', $sessionId)
            ->exists();

        if ($sudahFeedback) {
            return redirect()->route('aksi.show', $id);
        }

        AksiFeedback::create([
            'aksi_id'      => $id,
            'nama_peserta' => $validated['nama_peserta'],
            'komentar'     => $validated['komentar'],
            'session_id'   => $sessionId,
        ]);

        return redirect()->route('aksi.show', $id);
    }

    /**
     * Owner: Grace Magaretha Sirait
     */
    public function riwayat(Request $request)
    {
        $sessionId = session()->getId();
        $sort = $request->query('sort', 'newest_event');

        $query = AksiTandai::with('aksi')
            ->where('aksi_tandai.session_id', $sessionId)
            ->join('aksi_pelestarian', 'aksi_tandai.aksi_id', '=', 'aksi_pelestarian.id_aksi')
            ->select('aksi_tandai.*');

        if ($sort === 'oldest_event') {
            $query->orderByRaw('COALESCE(aksi_pelestarian.tanggal_kegiatan, "9999-12-31") ASC');
        } else {
            $query->orderByRaw('COALESCE(aksi_pelestarian.tanggal_kegiatan, "1000-01-01") DESC');
        }

        $riwayat = $query->paginate(10);

        return view('aksi.riwayat', compact('riwayat', 'sort'));
    }

    /**
     * Owner: Grace Magaretha Sirait
     */
    public function clearRiwayat()
    {
        $sessionId = session()->getId();

        $aksiIds = AksiTandai::where('session_id', $sessionId)->pluck('aksi_id');

        AksiTandai::where('session_id', $sessionId)->delete();
        AksiFeedback::where('session_id', $sessionId)->delete();

        foreach ($aksiIds as $aksiId) {
            session()->forget("tandai_aksi_{$aksiId}");
            session()->forget("tandai_aksi_{$aksiId}_nama");
        }

        return redirect()->route('aksi.riwayat');
    }
}