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
     * PBI-Search: Global Search
     */
    public function index(Request $request)
    {
        $query = $request->input('q', '');

        $searchIkan = collect();
        $searchEkosistem = collect();
        $searchAksi = collect();
        $totalResults = 0;

        if ($query) {
            $searchIkan = Ikan::where('nama', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->orWhere('habitat', 'like', "%{$query}%")
                ->orWhere('status_konservasi', 'like', "%{$query}%")
                ->limit(10)
                ->get();

            $searchEkosistem = Ekosistem::where('nama_ekosistem', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->orWhere('lokasi', 'like', "%{$query}%")
                ->limit(10)
                ->get();

            $searchAksi = AksiPelestarian::where('judul_aksi', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->orWhere('manfaat', 'like', "%{$query}%")
                ->limit(10)
                ->get();

            $totalResults = $searchIkan->count() + $searchEkosistem->count() + $searchAksi->count();
        }

        $randomContent = $this->getRandomContent();
        $popularActions = $this->getPopularActions();
        $leaderboard = $this->leaderboard();

        return view('home', compact(
            'query',
            'searchIkan',
            'searchEkosistem',
            'searchAksi',
            'totalResults',
            'randomContent',
            'popularActions',
            'leaderboard'
        ));
    }

    public function getRandomContent()
    {
        return [
            'ikan' => Ikan::inRandomOrder()->take(3)->get(),
            'ekosistem' => Ekosistem::inRandomOrder()->take(3)->get(),
            'aksi' => AksiPelestarian::inRandomOrder()->take(3)->get(),
        ];
    }

    public function getPopularActions()
    {
        return AksiPelestarian::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(5)
            ->with('createdBy')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id_aksi,
                    'title' => $item->judul_aksi,
                    'like_count' => $item->likes_count,
                    'creator' => [
                        'name' => $item->createdBy->name,
                        'badge' => $item->createdBy->badge,
                    ],
                ];
            });
    }

    public function leaderboard()
    {
        return User::orderByDesc('points')
            ->take(10)
            ->get()
            ->map(function ($user, $index) {
                return [
                    'rank' => $index + 1,
                    'name' => $user->name,
                    'points' => $user->points,
                    'badge' => $user->badge,
                ];
            });
    }
}