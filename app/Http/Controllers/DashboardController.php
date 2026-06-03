<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Ikan;
use App\Models\Ekosistem;
use App\Models\AksiPelestarian;

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

        $recentUploads = null;
        if ($user->isAdmin()) {
            $recentUploads = [
                'ikan'      => Ikan::latest()->take(3)->get(),
                'ekosistem' => Ekosistem::latest()->take(3)->get(),
                'aksi'      => AksiPelestarian::latest()->take(3)->get(),
            ];
        }

        return view('dashboard', [
            'user'          => $user,
            'bookmarkCount' => $bookmarkCount,
            'likeCount'     => $likeCount,
            'recentUploads' => $recentUploads,
        ]);
    }
}