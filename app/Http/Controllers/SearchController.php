<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Models\Ekosistem;
use App\Models\AksiPelestarian;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private const LIMIT = 10;

    /**
     * Owner: Siti
     * PBI-07: Search System
     */
    public function searchIkan(Request $request)
    {
        $keyword = $request->query('q', '');
        $page = $request->query('page', 1);

        if (empty($keyword)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Keyword is required',
                'data' => null,
            ], 400);
        }

        $query = Ikan::where('nama', 'LIKE', "%{$keyword}%")
            ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");

        $total = $query->count();
        $results = $query->take(self::LIMIT)
            ->offset((intval($page) - 1) * self::LIMIT)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id_ikan,
                    'title' => $item->nama,
                    'type' => 'ikan',
                    'description' => $item->deskripsi,
                    'image' => $item->gambar ? '/storage/' . $item->gambar : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'type' => 'ikan',
            'page' => intval($page),
            'per_page' => self::LIMIT,
            'total' => $total,
            'data' => $results,
        ]);
    }

    /**
     * Owner: Siti
     * PBI-07: Search System
     */
    public function searchEkosistem(Request $request)
    {
        $keyword = $request->query('q', '');
        $page = $request->query('page', 1);

        if (empty($keyword)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Keyword is required',
                'data' => null,
            ], 400);
        }

        $query = Ekosistem::where('nama_ekosistem', 'LIKE', "%{$keyword}%")
            ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");

        $total = $query->count();
        $results = $query->take(self::LIMIT)
            ->offset((intval($page) - 1) * self::LIMIT)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id_ekosistem,
                    'title' => $item->nama_ekosistem,
                    'type' => 'ekosistem',
                    'description' => $item->deskripsi,
                    'image' => $item->gambar ? '/storage/' . $item->gambar : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'type' => 'ekosistem',
            'page' => intval($page),
            'per_page' => self::LIMIT,
            'total' => $total,
            'data' => $results,
        ]);
    }

    /**
     * Owner: Siti
     * PBI-07: Search System
     */
    public function searchAksi(Request $request)
    {
        $keyword = $request->query('q', '');
        $page = $request->query('page', 1);

        if (empty($keyword)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Keyword is required',
                'data' => null,
            ], 400);
        }

        $query = AksiPelestarian::where('judul_aksi', 'LIKE', "%{$keyword}%")
            ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");

        $total = $query->count();
        $results = $query->take(self::LIMIT)
            ->offset((intval($page) - 1) * self::LIMIT)
            ->with('createdBy')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id_aksi,
                    'title' => $item->judul_aksi,
                    'type' => 'aksi',
                    'description' => $item->deskripsi,
                    'image' => $item->gambar ? '/storage/' . $item->gambar : null,
                    'created_by' => [
                        'name' => $item->createdBy->name,
                        'badge' => $item->createdBy->badge,
                    ],
                ];
            });

        return response()->json([
            'status' => 'success',
            'type' => 'aksi',
            'page' => intval($page),
            'per_page' => self::LIMIT,
            'total' => $total,
            'data' => $results,
        ]);
    }
}
