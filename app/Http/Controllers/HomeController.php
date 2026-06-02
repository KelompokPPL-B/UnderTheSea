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
     * PBI-37: Popular Content
     * PBI-38: Recommended Content with Pagination
     * PROJ-114: Latest Content Section
     * PBI-46: Homepage Statistics Summary
     */
    public function index(Request $request)
    {
        $rawQuery = $request->input('q', '');
        $query    = trim(preg_replace('/\s+/', ' ', $rawQuery));
        $page     = max(1, (int) $request->input('rec_page', 1));

        $searchIkan      = collect();
        $searchEkosistem = collect();
        $searchAksi      = collect();
        $totalResults    = 0;
        $isSearching     = false;

        if ($query !== '') {
            $isSearching = true;
            $keywords    = explode(' ', $query);
            $searchIkan      = $this->searchIkan($query, $keywords);
            $searchEkosistem = $this->searchEkosistem($query, $keywords);
            $searchAksi      = $this->searchAksi($query, $keywords);
            $totalResults    = $searchIkan->count() + $searchEkosistem->count() + $searchAksi->count();
        }

        $randomContent   = $this->getRandomContent();
        $popularActions  = $this->getPopularActions();
        $popularContent  = $this->getPopularContent();
        $recommendedData = $this->getRecommendedContent($request, $page);
        $latestContent   = $this->getLatestContent();
        $statistics      = $this->getStatistics();
        $leaderboard     = $this->leaderboard();

        return view('home', compact(
            'query', 'rawQuery', 'isSearching',
            'searchIkan', 'searchEkosistem', 'searchAksi', 'totalResults',
            'randomContent', 'popularActions', 'popularContent',
            'recommendedData', 'latestContent', 'statistics', 'leaderboard'
        ));
    }

    /**
     * PBI-46: Statistics Summary
     * Hitung total data yang tersedia di database
     */
    public function getStatistics(): array
    {
        return [
            'total_ikan'      => Ikan::count(),
            'total_ekosistem' => Ekosistem::count(),
            'total_aksi'      => AksiPelestarian::count(),
            'total_user'      => User::count(),
        ];
    }

    /**
     * PROJ-114: Latest Content
     */
    public function getLatestContent(): array
    {
        $latestIkan      = Ikan::orderByDesc('created_at')->take(3)->get();
        $latestEkosistem = Ekosistem::orderByDesc('created_at')->take(3)->get();
        $latestAksi      = AksiPelestarian::orderByDesc('created_at')->take(3)->get();

        $allLatest = collect();
        foreach ($latestIkan as $item) {
            $allLatest->push(['type' => 'ikan', 'data' => $item, 'created_at' => $item->created_at]);
        }
        foreach ($latestEkosistem as $item) {
            $allLatest->push(['type' => 'ekosistem', 'data' => $item, 'created_at' => $item->created_at]);
        }
        foreach ($latestAksi as $item) {
            $allLatest->push(['type' => 'aksi', 'data' => $item, 'created_at' => $item->created_at]);
        }

        return [
            'ikan'      => $latestIkan,
            'ekosistem' => $latestEkosistem,
            'aksi'      => $latestAksi,
            'mixed'     => $allLatest->sortByDesc('created_at')->take(6)->values(),
        ];
    }

    /**
     * PBI-38: Recommended Content with Pagination
     */
    public function getRecommendedContent(Request $request, int $page = 1): array
    {
        $perPage = 6;

        $ikan      = Ikan::inRandomOrder()->take(20)->get()->map(fn($i) => ['type' => 'ikan', 'data' => $i]);
        $ekosistem = Ekosistem::inRandomOrder()->take(20)->get()->map(fn($i) => ['type' => 'ekosistem', 'data' => $i]);
        $aksi      = AksiPelestarian::inRandomOrder()->take(20)->get()->map(fn($i) => ['type' => 'aksi', 'data' => $i]);

        $allItems   = $ikan->merge($ekosistem)->merge($aksi)->shuffle()->values();
        $total      = $allItems->count();
        $totalPages = max(1, (int) ceil($total / $perPage));
        $page       = min($page, $totalPages);
        $items      = $allItems->slice(($page - 1) * $perPage, $perPage)->values();

        return [
            'items'       => $items,
            'page'        => $page,
            'total_pages' => $totalPages,
            'total'       => $total,
            'per_page'    => $perPage,
        ];
    }

    /**
     * PBI-37: Popular Content
     */
    public function getPopularContent(): array
    {
        $popularIkan = Ikan::select('ikan.*')
            ->selectRaw('(SELECT COUNT(*) FROM user_views WHERE user_views.content_type = "ikan" AND user_views.content_id = ikan.id_ikan) + (SELECT COUNT(*) * 2 FROM favorites WHERE favorites.type = "ikan" AND favorites.item_id = ikan.id_ikan) AS popularity_score')
            ->orderByRaw('popularity_score DESC')->take(3)->get();

        $popularEkosistem = Ekosistem::select('ekosistem.*')
            ->selectRaw('(SELECT COUNT(*) FROM user_views WHERE user_views.content_type = "ekosistem" AND user_views.content_id = ekosistem.id_ekosistem) + (SELECT COUNT(*) * 2 FROM favorites WHERE favorites.type = "ekosistem" AND favorites.item_id = ekosistem.id_ekosistem) AS popularity_score')
            ->orderByRaw('popularity_score DESC')->take(3)->get();

        $popularAksi = AksiPelestarian::select('aksi_pelestarian.*')
            ->selectRaw('(SELECT COUNT(*) FROM user_views WHERE user_views.content_type = "aksi" AND user_views.content_id = aksi_pelestarian.id_aksi) + (SELECT COUNT(*) * 2 FROM favorites WHERE favorites.type = "aksi" AND favorites.item_id = aksi_pelestarian.id_aksi) AS popularity_score')
            ->orderByRaw('popularity_score DESC')->take(3)->get();

        return ['ikan' => $popularIkan, 'ekosistem' => $popularEkosistem, 'aksi' => $popularAksi];
    }

    /**
     * PBI-15: Search ikan
     */
    private function searchIkan(string $query, array $keywords)
    {
        $exact = Ikan::where(function ($q) use ($query) {
            $q->where('nama', 'like', "%{$query}%")->orWhere('deskripsi', 'like', "%{$query}%")
              ->orWhere('habitat', 'like', "%{$query}%")->orWhere('karakteristik', 'like', "%{$query}%")
              ->orWhere('status_konservasi', 'like', "%{$query}%")->orWhere('fakta_unik', 'like', "%{$query}%");
        })->limit(10)->get();
        if ($exact->count() > 0) return $exact;
        return Ikan::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('nama', 'like', "%{$word}%")->orWhere('deskripsi', 'like', "%{$word}%")
                  ->orWhere('habitat', 'like', "%{$word}%")->orWhere('karakteristik', 'like', "%{$word}%")
                  ->orWhere('status_konservasi', 'like', "%{$word}%");
            }
        })->limit(10)->get();
    }

    /**
     * PBI-15: Search ekosistem
     */
    private function searchEkosistem(string $query, array $keywords)
    {
        $exact = Ekosistem::where(function ($q) use ($query) {
            $q->where('nama_ekosistem', 'like', "%{$query}%")->orWhere('deskripsi', 'like', "%{$query}%")
              ->orWhere('lokasi', 'like', "%{$query}%")->orWhere('peran', 'like', "%{$query}%")
              ->orWhere('ancaman', 'like', "%{$query}%");
        })->limit(10)->get();
        if ($exact->count() > 0) return $exact;
        return Ekosistem::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('nama_ekosistem', 'like', "%{$word}%")->orWhere('deskripsi', 'like', "%{$word}%")
                  ->orWhere('lokasi', 'like', "%{$word}%")->orWhere('peran', 'like', "%{$word}%");
            }
        })->limit(10)->get();
    }

    /**
     * PBI-15: Search aksi
     */
    private function searchAksi(string $query, array $keywords)
    {
        $exact = AksiPelestarian::where(function ($q) use ($query) {
            $q->where('judul_aksi', 'like', "%{$query}%")->orWhere('deskripsi', 'like', "%{$query}%")
              ->orWhere('manfaat', 'like', "%{$query}%")->orWhere('cara_melakukan', 'like', "%{$query}%");
        })->limit(10)->get();
        if ($exact->count() > 0) return $exact;
        return AksiPelestarian::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('judul_aksi', 'like', "%{$word}%")->orWhere('deskripsi', 'like', "%{$word}%")
                  ->orWhere('manfaat', 'like', "%{$word}%");
            }
        })->limit(10)->get();
    }

    /**
     * PBI-08: Random content
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
     * PBI-08: Popular actions
     */
    public function getPopularActions()
    {
        return AksiPelestarian::withCount('likes')->orderByDesc('likes_count')
            ->take(5)->with('createdBy')->get()
            ->map(fn($item) => [
                'id'         => $item->id_aksi,
                'title'      => $item->judul_aksi,
                'like_count' => $item->likes_count,
                'creator'    => ['name' => $item->createdBy->name, 'badge' => $item->createdBy->badge],
            ]);
    }

    /**
     * PBI-06: Leaderboard
     */
    public function leaderboard()
    {
        return User::orderByDesc('points')->take(10)->get()
            ->map(fn($user, $index) => [
                'rank'   => $index + 1,
                'name'   => $user->name,
                'points' => $user->points,
                'badge'  => $user->badge,
            ]);
    }
}