<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to bookmark.',
                'data' => null,
            ], 401);
        }

        $validated = $request->validate([
            'type' => 'required|string|in:ikan,ekosistem,aksi',
            'item_id' => 'required|integer',
        ]);

        $existing = Favorite::where('user_id', auth()->id())
            ->where('type', $validated['type'])
            ->where('item_id', $validated['item_id'])
            ->first();

        if ($existing) {
            return response()->json([
                'status' => 'error',
                'message' => 'Already bookmarked.',
                'data' => null,
            ], 400);
        }

        try {
            $fav = Favorite::create([
                'user_id' => auth()->id(),
                'type' => $validated['type'],
                'item_id' => $validated['item_id'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Bookmarked successfully.',
                'data' => $fav,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to bookmark.',
                'data' => null,
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to remove bookmark.',
                'data' => null,
            ], 401);
        }

        $validated = $request->validate([
            'type' => 'required|string|in:ikan,ekosistem,aksi',
            'item_id' => 'required|integer',
        ]);

        $fav = Favorite::where('user_id', auth()->id())
            ->where('type', $validated['type'])
            ->where('item_id', $validated['item_id'])
            ->first();

        if (!$fav) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bookmark not found.',
                'data' => null,
            ], 404);
        }

        try {
            $fav->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Bookmark removed successfully.',
                'data' => null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove bookmark.',
                'data' => null,
            ], 500);
        }
    }

    public function index(Request $request)
    {
        if (!auth()->check()) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You must be logged in.',
                    'data' => null,
                ], 401);
            }
            return redirect()->route('login');
        }

        $favorites = Favorite::where('user_id', auth()->id())->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Favorites retrieved successfully.',
                'data' => $favorites,
            ]);
        }

        // Fallback to redirecting to dashboard with active filter if needed, or returning a basic view.
        // Let's redirect to dashboard since it shows stats and allows filtering.
        return redirect()->route('dashboard');
    }
}
