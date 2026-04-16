<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Owner: Grace
     * PBI-02: Bookmark System
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to bookmark',
                'data' => null,
            ], 401);
        }

        $validated = $request->validate([
            'type' => 'required|in:ikan,ekosistem,aksi',
            'item_id' => 'required|integer',
        ]);

        try {
            $favorite = Favorite::create([
                'user_id' => auth()->id(),
                'type' => $validated['type'],
                'item_id' => $validated['item_id'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Bookmark added successfully',
                'data' => [
                    'id' => $favorite->id_favorite,
                    'type' => $favorite->type,
                    'item_id' => $favorite->item_id,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add bookmark',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Owner: Grace
     * PBI-02: Bookmark System
     */
    public function destroy(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to remove bookmark',
                'data' => null,
            ], 401);
        }

        $validated = $request->validate([
            'type' => 'required|in:ikan,ekosistem,aksi',
            'item_id' => 'required|integer',
        ]);

        $favorite = Favorite::where('user_id', auth()->id())
            ->where('type', $validated['type'])
            ->where('item_id', $validated['item_id'])
            ->first();

        if (!$favorite) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bookmark not found',
                'data' => null,
            ], 404);
        }

        $favorite->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Bookmark removed successfully',
            'data' => null,
        ]);
    }

    /**
     * Owner: Grace
     * PBI-02: Bookmark System
     */
    public function index()
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in',
                'data' => null,
            ], 401);
        }

        $favorites = Favorite::where('user_id', auth()->id())->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Bookmarks retrieved successfully',
            'data' => $favorites,
        ]);
    }

    /**
     * Owner: Grace
     * PBI-27: Bookmark List Page
     */
    public function bookmarks()
    {
        if (!auth()->check()) {
            abort(401);
        }

        $favorites = Favorite::where('user_id', auth()->id())->get();

        return view('bookmarks.index', compact('favorites'));
    }
}
