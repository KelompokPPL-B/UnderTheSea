<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Models\Ekosistem;
use App\Models\AksiPelestarian;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Owner: Keziah
     * PBI-08: Homepage
     */
    public function index()
    {
        $randomContent = $this->getRandomContent();
        $popularActions = $this->getPopularActions();
        $leaderboard = $this->leaderboard();

        return view('home', compact('randomContent', 'popularActions', 'leaderboard'));
    }

    /**
     * Owner: Keziah
     * PBI-08: Homepage
     */
    public function getRandomContent()
    {
        $ikan = Ikan::inRandomOrder()->take(3)->get();
        $ekosistem = Ekosistem::inRandomOrder()->take(3)->get();
        $aksi = AksiPelestarian::inRandomOrder()->take(3)->get();

        return [
            'ikan' => $ikan,
            'ekosistem' => $ekosistem,
            'aksi' => $aksi,
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
                    'rank' => $index + 1,
                    'name' => $user->name,
                    'points' => $user->points,
                    'badge' => $user->badge,
                ];
            });
    }
}
