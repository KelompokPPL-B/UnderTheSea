<?php

namespace App\Http\Controllers;

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

        return view('dashboard', [
            'user' => $user,
            'bookmarkCount' => $bookmarkCount,
            'likeCount' => $likeCount,
        ]);
    }
}
