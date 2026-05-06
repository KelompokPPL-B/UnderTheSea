<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Models\Ekosistem;
use App\Models\AksiPelestarian;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Owner: Keziah
     * PBI-08: Homepage
     * PBI-15: Search Enhancement
     */
    public function index(Request $request)
    {
        $rawQuery = $request->input('q', '');

        // PBI-15: trim whitespace & normalize spasi berlebih
        $query = trim(preg_replace('/\s+/', ' ', $rawQuery));

        $searchIkan      = collect();
        $searchEkosistem = collect();
        $searchAksi      = collect();
        $totalResults    = 0;
        $isSearching     = false;

        // PBI-15: hanya search jika query tidak kosong
        if ($query !== '') {
            $isSearching = true;

            // PBI-15: pecah keyword jadi kata-kata untuk multi-keyword search
            // contoh: "ikan koi" → cari yang mengandung "ikan" DAN/ATAU "koi"
            $keywords = explode(' ', $query);

            $searchIkan = $this->searchIkan($query, $keywords);
            $searchEkosistem = $this->searchEkosistem($query, $keywords);
            $searchAksi = $this->searchAksi($query, $keywords);

            $totalResults = $searchIkan->count()
                          + $searchEkosistem->count()
                          + $searchAksi->count();
        }

        $randomContent  = $this->getRandomContent();
        $popularActions = $this->getPopularActions();
        $leaderboard    = $this->leaderboard();

        return view('home', compact(
            'query',
            'rawQuery',
            'isSearching',
            'searchIkan',
            'searchEkosistem',
            'searchAksi',
            'totalResults',
            'randomContent',
            'popularActions',
            'leaderboard'
        ));
    }

    /**
     * PBI-15: Search ikan dengan multi-keyword support
     * MySQL LIKE sudah case-insensitive by default (collation utf8_general_ci)
     */
    private function searchIkan(string $query, array $keywords)
    {
        $q = Ikan::query();

        // Match exact phrase dulu (prioritas lebih tinggi)
        $exactMatches = Ikan::where(function ($q) use ($query) {
            $q->where('nama', 'like', "%{$query}%")
              ->orWhere('deskripsi', 'like', "%{$query}%")
              ->orWhere('habitat', 'like', "%{$query}%")
              ->orWhere('karakteristik', 'like', "%{$query}%")
              ->orWhere('status_konservasi', 'like', "%{$query}%")
              ->orWhere('fakta_unik', 'like', "%{$query}%");
        })->limit(10)->get();

        if ($exactMatches->count() > 0) {
            return $exactMatches;
        }

        // Fallback: match per kata (untuk multi-keyword)
        return Ikan::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('nama', 'like', "%{$word}%")
                  ->orWhere('deskripsi', 'like', "%{$word}%")
                  ->orWhere('habitat', 'like', "%{$word}%")
                  ->orWhere('karakteristik', 'like', "%{$word}%")
                  ->orWhere('status_konservasi', 'like', "%{$word}%");
            }
        })->limit(10)->get();
    }

    /**
     * PBI-15: Search ekosistem dengan multi-keyword support
     */
    private function searchEkosistem(string $query, array $keywords)
    {
        $exactMatches = Ekosistem::where(function ($q) use ($query) {
            $q->where('nama_ekosistem', 'like', "%{$query}%")
              ->orWhere('deskripsi', 'like', "%{$query}%")
              ->orWhere('lokasi', 'like', "%{$query}%")
              ->orWhere('peran', 'like', "%{$query}%")
              ->orWhere('ancaman', 'like', "%{$query}%");
        })->limit(10)->get();

        if ($exactMatches->count() > 0) {
            return $exactMatches;
        }

        return Ekosistem::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('nama_ekosistem', 'like', "%{$word}%")
                  ->orWhere('deskripsi', 'like', "%{$word}%")
                  ->orWhere('lokasi', 'like', "%{$word}%")
                  ->orWhere('peran', 'like', "%{$word}%");
            }
        })->limit(10)->get();
    }

    /**
     * PBI-15: Search aksi dengan multi-keyword support
     */
    private function searchAksi(string $query, array $keywords)
    {
        $exactMatches = AksiPelestarian::where(function ($q) use ($query) {
            $q->where('judul_aksi', 'like', "%{$query}%")
              ->orWhere('deskripsi', 'like', "%{$query}%")
              ->orWhere('manfaat', 'like', "%{$query}%")
              ->orWhere('cara_melakukan', 'like', "%{$query}%");
        })->limit(10)->get();

        if ($exactMatches->count() > 0) {
            return $exactMatches;
        }

        return AksiPelestarian::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('judul_aksi', 'like', "%{$word}%")
                  ->orWhere('deskripsi', 'like', "%{$word}%")
                  ->orWhere('manfaat', 'like', "%{$word}%");
            }
        })->limit(10)->get();
    }

    /**
     * Owner: Keziah
     * PBI-08: Homepage
     */
    public function getRandomContent()
    {
        return [
            'ikan'      => Ikan::inRandomOrder()->take(3)->get(),
            'ekosistem' => Ekosistem::inRandomOrder()->take(3)->get(),
            'aksi'      => AksiPelestarian::inRandomOrder()->take(3)->get(),
        ];
    }

    /**
     * Owner: Keziah
     * PBI-08: Homepage
     */
    public function getPopularActions()
    {
        return AksiPelestarian::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(5)
            ->with('createdBy')
            ->get()
            ->map(function ($item) {
                return [
                    'id'         => $item->id_aksi,
                    'title'      => $item->judul_aksi,
                    'like_count' => $item->likes_count,
                    'creator'    => [
                        'name'  => $item->createdBy->name,
                        'badge' => $item->createdBy->badge,
                    ],
                ];
            });
    }

    /**
     * Owner: Keziah
     * PBI-06: Leaderboard
     */
    public function leaderboard()
    {
        return User::orderByDesc('points')
            ->take(10)
            ->get()
            ->map(function ($user, $index) {
                return [
                    'rank'   => $index + 1,
                    'name'   => $user->name,
                    'points' => $user->points,
                    'badge'  => $user->badge,
                ];
            });
    }
}