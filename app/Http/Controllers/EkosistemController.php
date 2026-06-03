<?php

namespace App\Http\Controllers;

use App\Models\Ekosistem;
use App\Services\PointsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkosistemController extends Controller
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
        $filterLikes = $request->query('filter_likes');
        $filterBookmarks = $request->query('filter_bookmarks');
        $filterLokasi = $request->query('lokasi', '');

        $query = Ekosistem::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_ekosistem', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if (!empty($filterLokasi)) {
            $query->where('lokasi', $filterLokasi);
        }

        if ($filterLikes !== null) {
            if (empty(trim($filterLikes))) {
                $query->whereRaw('1 = 0');
            } else {
                $ids = array_filter(explode(',', $filterLikes));
                $query->whereIn('id_ekosistem', $ids);
            }
        }

        if ($filterBookmarks !== null) {
            if (empty(trim($filterBookmarks))) {
                $query->whereRaw('1 = 0');
            } else {
                $ids = array_filter(explode(',', $filterBookmarks));
                $query->whereIn('id_ekosistem', $ids);
            }
        }

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'name_asc') {
            $query->orderBy('nama_ekosistem', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('nama_ekosistem', 'desc');
        } else {
            $sort = 'newest';
            $query->orderBy('created_at', 'desc');
        }

        $ekosistem = $query->paginate(10)->withQueryString();

        $lokasiList = Ekosistem::select('lokasi')
            ->whereNotNull('lokasi')
            ->where('lokasi', '!=', '')
            ->distinct()
            ->orderBy('lokasi')
            ->pluck('lokasi');

        return view('ekosistem.index', compact(
            'ekosistem',
            'sort',
            'search',
            'filterLokasi',
            'lokasiList'
        ));
    }

    public function create()
    {
        return view('ekosistem.create');
    }

    public function show($id)
    {
        $ekosistem = Ekosistem::findOrFail($id);

        $relatedEkosistems = Ekosistem::where('id_ekosistem', '!=', $id)
            ->inRandomOrder()
            ->get();

        if (auth()->check()) {
            $this->pointsService->awardPoints(auth()->id(), 'ekosistem', $id);
        }

        return view('ekosistem.show', compact('ekosistem', 'relatedEkosistems'));
    }

    public function edit($id)
    {
        $ekosistem = Ekosistem::findOrFail($id);

        return view('ekosistem.edit', compact('ekosistem'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $validated = $request->validate([
            'nama_ekosistem'   => 'required|string|min:5|max:50|unique:ekosistem,nama_ekosistem',
            'deskripsi'        => 'required|string|min:10|max:255',
            'lokasi'           => 'required|string|min:5|max:50',
            'peran'            => 'required|string|min:5|max:50',
            'ancaman'          => 'required|string|min:10|max:100',
            'cara_menjaga'     => 'nullable|string',
            'larangan'         => 'nullable|string',
            'dampak_kerusakan' => 'nullable|string',
            'gambar'           => 'required|image|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png|max:2048',
        ], [
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.image'    => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes'    => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        }

        $validated['created_by'] = auth()->id();

        Ekosistem::create($validated);

        return redirect()->route('ekosistem.index')
            ->with('success', 'Ecosystem created successfully!');
    }

    public function update(Request $request, $id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ekosistem = Ekosistem::findOrFail($id);

        $validated = $request->validate([
            'nama_ekosistem'   => 'required|string|min:5|max:50|unique:ekosistem,nama_ekosistem,' . $id . ',id_ekosistem',
            'deskripsi'        => 'required|string|min:10|max:255',
            'lokasi'           => 'required|string|min:5|max:50',
            'peran'            => 'required|string|min:5|max:50',
            'ancaman'          => 'required|string|min:10|max:100',
            'cara_menjaga'     => 'nullable|string',
            'larangan'         => 'nullable|string',
            'dampak_kerusakan' => 'nullable|string',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png|mimetypes:image/jpeg,image/png|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            if ($ekosistem->gambar) {
                Storage::disk('public')->delete($ekosistem->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('ecosystem', 'public');
        } else {
            unset($validated['gambar']);
        }

        $ekosistem->update($validated);

        return redirect()->route('ekosistem.show', $id)
            ->with('success', 'Ecosystem updated successfully!');
    }

    public function destroy($id)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $ekosistem = Ekosistem::findOrFail($id);

        if ($ekosistem->gambar) {
            Storage::disk('public')->delete($ekosistem->gambar);
        }

        $ekosistem->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Ecosystem deleted successfully',
                'data'    => null,
            ]);
        }

        return redirect()->route('ekosistem.index')
            ->with('success', 'Ecosystem deleted successfully!');
    }
}