<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Models\Ekosistem;
use App\Models\AksiPelestarian;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

        // Data Distribution queries for Admin Monitoring
        $fishStatusDistribution = Ikan::select('status_konservasi', DB::raw('count(*) as count'))
            ->whereNotNull('status_konservasi')
            ->where('status_konservasi', '<>', '')
            ->groupBy('status_konservasi')
            ->orderByDesc('count')
            ->get();

        $fishHabitatDistribution = Ikan::select('habitat', DB::raw('count(*) as count'))
            ->whereNotNull('habitat')
            ->where('habitat', '<>', '')
            ->groupBy('habitat')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        $actionTypeDistribution = AksiPelestarian::select('is_user_generated', DB::raw('count(*) as count'))
            ->groupBy('is_user_generated')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->is_user_generated ? 'User Contribution' : 'Official Action',
                    'count' => $item->count,
                ];
            });

        // User Activity & Engagement Metrics for Charting
        $totalBookmarks = \App\Models\Favorite::count();
        $totalLikes = \App\Models\Like::count();
        $totalViews = DB::table('user_views')->count();

        $viewsByContentType = DB::table('user_views')
            ->select('content_type', DB::raw('count(*) as count'))
            ->groupBy('content_type')
            ->get()
            ->map(function ($item) {
                $label = match($item->content_type) {
                    'ikan' => 'Fish',
                    'ekosistem' => 'Ecosystems',
                    'aksi' => 'Actions',
                    default => ucfirst($item->content_type)
                };
                return [
                    'label' => $label,
                    'count' => $item->count
                ];
            });

        // Featured content for user dashboard Insight section (4 cards)
        $featuredContent = Ikan::inRandomOrder()->take(4)->get();

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
            'fishStatusDistribution' => $fishStatusDistribution,
            'fishHabitatDistribution' => $fishHabitatDistribution,
            'actionTypeDistribution' => $actionTypeDistribution,
            'totalBookmarks' => $totalBookmarks,
            'totalLikes' => $totalLikes,
            'totalViews' => $totalViews,
            'viewsByContentType' => $viewsByContentType,
            'featuredContent' => $featuredContent,
        ]);
    }
}

