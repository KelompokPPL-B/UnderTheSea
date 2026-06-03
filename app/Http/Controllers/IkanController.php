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

        // SEARCH IKAN
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('habitat', 'like', "%{$search}%");
            });
        }

        // SORT IKAN
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

        // PAGINATION
        $ikans = $query->paginate(12)->withQueryString();

        // Alias supaya aman kalau view lama masih pakai variable $ikan
        $ikan = $ikans;

        return view('ikan.index', compact('ikans', 'ikan', 'sort', 'search'));
    }

    public function create()
    {
        return view('ikan.create');
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
        $ikan = Ikan::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $ikan->created_by) {
            abort(403);
        }

        return view('ikan.edit', compact('ikan'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'habitat'           => 'nullable|string|max:255',
            'karakteristik'     => 'nullable|string',
            'status_konservasi' => 'nullable|string|max:100',
            'fakta_unik'        => 'nullable|string',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2MB.',
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

    public function update(Request $request, $id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ikan = Ikan::findOrFail($id);

        if (!auth()->user()->isAdmin() && auth()->id() !== $ikan->created_by) {
            abort(403);
        }

        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'habitat'           => 'nullable|string|max:255',
            'karakteristik'     => 'nullable|string',
            'status_konservasi' => 'nullable|string|max:100',
            'fakta_unik'        => 'nullable|string',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2MB.',
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

        return redirect()->route('ikan.show', $id)
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

        return response()->json([
            'status'  => 'success',
            'message' => 'Fish deleted successfully',
            'data'    => null,
        ]);
    }
}