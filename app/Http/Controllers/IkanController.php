<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Services\PointsService;
use App\Services\SanitizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IkanController extends Controller
{
    private PointsService $pointsService;

    public function __construct(PointsService $pointsService)
    {
        $this->pointsService = $pointsService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:100|regex:/^[a-zA-Z0-9\s]*$/',
        ], [
            'search.max' => 'Kata kunci pencarian tidak boleh melebihi 100 karakter.',
            'search.regex' => 'Kata kunci pencarian tidak boleh mengandung karakter spesial.',
        ]);

        $sort = $request->query('sort', 'newest');
        $search = $request->query('search');

        $query = Ikan::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('habitat', 'like', "%{$search}%")
                    ->orWhere('status_konservasi', 'like', "%{$search}%");
            });
        }

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'name_asc') {
            $query->orderBy('nama', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('nama', 'desc');
        } else {
            $sort = 'newest';
            $query->orderBy('created_at', 'desc');
        }

        $ikans = $query->paginate(12)->withQueryString();

        // Biar view lama yang masih pakai $ikan tetap aman
        $ikan = $ikans;

        return view('ikan.index', compact('ikans', 'ikan', 'sort', 'search'));
    }

    public function create()
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('ikan.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'habitat'           => 'required|string|max:255',
            'karakteristik'     => 'required|string',
            'status_konservasi' => 'required|string|max:100',
            'fakta_unik'        => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama.required'              => 'Nama ikan wajib diisi.',
            'deskripsi.required'         => 'Deskripsi wajib diisi.',
            'habitat.required'           => 'Habitat wajib diisi.',
            'karakteristik.required'     => 'Karakteristik wajib diisi.',
            'status_konservasi.required' => 'Status konservasi wajib diisi.',
            'fakta_unik.required'        => 'Fakta unik wajib diisi.',
            'gambar.image'               => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes'               => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'                 => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated = SanitizationService::sanitizeArray($validated);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('fish', 'public');
        }

        $validated['created_by'] = auth()->id();

        Ikan::create($validated);

        return redirect()->route('ikan.index')
            ->with('success', 'Fish created successfully!');
    }

    public function show($id)
    {
        $ikan = Ikan::findOrFail($id);

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'ikan', $id);
        }

        return view('ikan.show', compact('ikan'));
    }

    public function edit($id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ikan = Ikan::findOrFail($id);

        return view('ikan.edit', compact('ikan'));
    }

    public function update(Request $request, $id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ikan = Ikan::findOrFail($id);

        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'habitat'           => 'required|string|max:255',
            'karakteristik'     => 'required|string',
            'status_konservasi' => 'required|string|max:100',
            'fakta_unik'        => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama.required'              => 'Nama ikan wajib diisi.',
            'deskripsi.required'         => 'Deskripsi wajib diisi.',
            'habitat.required'           => 'Habitat wajib diisi.',
            'karakteristik.required'     => 'Karakteristik wajib diisi.',
            'status_konservasi.required' => 'Status konservasi wajib diisi.',
            'fakta_unik.required'        => 'Fakta unik wajib diisi.',
            'gambar.image'               => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes'               => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'                 => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated = SanitizationService::sanitizeArray($validated);

        if ($request->hasFile('gambar')) {
            if ($ikan->gambar) {
                Storage::disk('public')->delete($ikan->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('fish', 'public');
        } else {
            unset($validated['gambar']);
        }

        $ikan->update($validated);

        return redirect()->route('ikan.show', $ikan->id_ikan)
            ->with('success', 'Fish updated successfully!');
    }

    public function destroy($id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ikan = Ikan::findOrFail($id);

        if ($ikan->gambar) {
            Storage::disk('public')->delete($ikan->gambar);
        }

        $ikan->delete();

        return redirect()->route('ikan.index')
            ->with('success', 'Fish deleted successfully!');
    }
}