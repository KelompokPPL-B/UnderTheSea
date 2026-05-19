<?php

namespace App\Http\Controllers;

use App\Models\AksiPelestarian;
use App\Models\AksiTandai; // Ditambahkan untuk mengelola pencatatan data aksi ditandai
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
            'judul_aksi'           => 'required|string|max:200',
            'deskripsi'            => 'nullable|string|max:5000',
            'manfaat'              => 'nullable|string|max:3000',
            'cara_melakukan'       => 'nullable|string|max:3000',
            'lokasi'               => 'nullable|string|max:255',
            'tanggal_kegiatan'     => 'nullable|date|after_or_equal:today',
            'tujuan_konservasi'    => 'nullable|string|max:500',
            'isu_lingkungan'       => 'nullable|string|max:500',
            'volunteer_dibutuhkan' => 'nullable|integer|min:1|max:10000',
            'dampak_aksi'          => 'nullable|string|max:3000',
            'gambar'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'judul_aksi.required'           => 'Title is required.',
            'judul_aksi.max'                => 'Title must not exceed 200 characters.',
            'deskripsi.max'                 => 'Description must not exceed 5000 characters.',
            'manfaat.max'                   => 'Benefits must not exceed 3000 characters.',
            'cara_melakukan.max'            => 'How to Participate must not exceed 3000 characters.',
            'lokasi.max'                    => 'Location must not exceed 255 characters.',
            'tanggal_kegiatan.date'         => 'Event Date must be a valid date.',
            'tanggal_kegiatan.after_or_equal' => 'Event Date must be today or in the future.',
            'tujuan_konservasi.max'         => 'Conservation Goals must not exceed 500 characters.',
            'isu_lingkungan.max'            => 'Environmental Issue must not exceed 500 characters.',
            'volunteer_dibutuhkan.integer'  => 'Volunteer Needed must be a number.',
            'volunteer_dibutuhkan.min'      => 'Volunteer Needed must be at least 1.',
            'volunteer_dibutuhkan.max'      => 'Volunteer Needed must not exceed 10,000.',
            'dampak_aksi.max'               => 'Action Impact must not exceed 3000 characters.',
            'gambar.image'                  => 'The file must be an image.',
            'gambar.mimes'                  => 'Image must be in JPG or PNG format.',
            'gambar.max'                    => 'Image size must not exceed 2MB.',
        ]);

        // Sanitize text fields
        $textFields = ['judul_aksi', 'deskripsi', 'manfaat', 'cara_melakukan', 'lokasi', 'tujuan_konservasi', 'isu_lingkungan', 'dampak_aksi'];
        foreach ($textFields as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = SanitizationService::sanitize($validated[$field]);
            }
        }

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
            'judul_aksi'           => 'required|string|max:200',
            'deskripsi'            => 'nullable|string|max:5000',
            'manfaat'              => 'nullable|string|max:3000',
            'cara_melakukan'       => 'nullable|string|max:3000',
            'lokasi'               => 'nullable|string|max:255',
            'tanggal_kegiatan'     => 'nullable|date',
            'tujuan_konservasi'    => 'nullable|string|max:500',
            'isu_lingkungan'       => 'nullable|string|max:500',
            'volunteer_dibutuhkan' => 'nullable|integer|min:1|max:10000',
            'dampak_aksi'          => 'nullable|string|max:3000',
            'gambar'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'judul_aksi.required'           => 'Title is required.',
            'judul_aksi.max'                => 'Title must not exceed 200 characters.',
            'gambar.mimes'                  => 'Image must be in JPG or PNG format.',
            'gambar.max'                    => 'Image size must not exceed 2MB.',
            'volunteer_dibutuhkan.integer'  => 'Volunteer Needed must be a number.',
            'volunteer_dibutuhkan.min'      => 'Volunteer Needed must be at least 1.',
        ]);

        $textFields = ['judul_aksi', 'deskripsi', 'manfaat', 'cara_melakukan', 'lokasi', 'tujuan_konservasi', 'isu_lingkungan', 'dampak_aksi'];
        foreach ($textFields as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = SanitizationService::sanitize($validated[$field]);
            }
        }

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('action', 'public');
        }

        $aksi->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Action updated successfully',
            'data'    => $aksi,
        ]);
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
            'status'  => 'success',
            'message' => 'Action deleted successfully',
            'data'    => null,
        ]);
    }

    /**
     * Owner: Grace Magaretha Sirait
     * PBI-26: Detail Ecosystem - Mark Completed Action
     * Menyimpan data partisipan yang menandai aksi selesai
     */
    public function tandai(Request $request, $id)
    {
        $request->validate([
            'nama_peserta' => 'required|string|max:100',
        ], [
            'nama_peserta.required' => 'Your name is required to mark this action.',
            'nama_peserta.max'      => 'Name must not exceed 100 characters.',
        ]);

        $sessionId = $request->session()->getId();
        $isAlreadyMarked = AksiTandai::where('aksi_id', $id)
                                      ->where('session_id', $sessionId)
                                      ->exists();

        if (!$isAlreadyMarked) {
            AksiTandai::create([
                'aksi_id'      => $id,
                'nama_peserta' => SanitizationService::sanitize($request->nama_peserta),
                'session_id'   => $sessionId,
                'ditandai_pada'=> now(),
            ]);
        }

        $request->session()->put("tandai_aksi_{$id}", true);
        $request->session()->put("tandai_aksi_{$id}_nama", $request->nama_peserta);

        return redirect()->back()->with('success', 'Thank you! You have successfully marked your participation.');
    }

    /**
     * Owner: Grace Magaretha Sirait
     * PBI-26: Detail Ecosystem - Remove Mark Action
     * Menghapus data partisipan (membatalkan tanda)
     */
    public function batalTandai(Request $request, $id)
    {
        $sessionId = $request->session()->getId();

        AksiTandai::where('aksi_id', $id)
                  ->where('session_id', $sessionId)
                  ->delete();

        $request->session()->forget("tandai_aksi_{$id}");
        $request->session()->forget("tandai_aksi_{$id}_nama");

        return redirect()->back()->with('success', 'Your participation mark has been removed.');
    }
}