<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Models\Ekosistem;
use App\Models\AksiPelestarian;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Owner: System
     * Display the dashboard
     */
    public function index(): View
    {
        $user = auth()->user();
        $bookmarkCount = $user->favorites()->count();
        $likeCount = $user->likes()->count();

        $fish = Ikan::take(3)->get();
        $ecosystems = Ekosistem::take(3)->get();
        $actions = AksiPelestarian::take(3)->get();
        $popularActions = AksiPelestarian::withCount('likes')->orderByDesc('likes_count')->take(5)->get();
        $leaderboard = User::orderByDesc('points')->take(10)->get();

        // Admin stats counters
        $usersCount = User::count();
        $totalFishCount = Ikan::count();
        $totalEcosystemsCount = Ekosistem::count();
        $totalActionsCount = AksiPelestarian::count();

        return view('dashboard', [
            'user' => $user,
            'bookmarkCount' => $bookmarkCount,
            'likeCount' => $likeCount,
            'fish' => $fish,
            'ecosystems' => $ecosystems,
            'actions' => $actions,
            'popularActions' => $popularActions,
            'leaderboard' => $leaderboard,
            'usersCount' => $usersCount,
            'totalFishCount' => $totalFishCount,
            'totalEcosystemsCount' => $totalEcosystemsCount,
            'totalActionsCount' => $totalActionsCount,
        ]);
    }
}

