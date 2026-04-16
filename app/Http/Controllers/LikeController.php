<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Owner: Grace
     * PBI-03: Like System
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to like',
                'data' => null,
            ], 401);
        }

        $validated = $request->validate([
            'action_id' => 'required|integer|exists:aksi_pelestarian,id_aksi',
        ]);

        $existingLike = Like::where('user_id', auth()->id())
            ->where('action_id', $validated['action_id'])
            ->first();

        if ($existingLike) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already liked this action',
                'data' => null,
            ], 400);
        }

        try {
            Like::create([
                'user_id' => auth()->id(),
                'action_id' => $validated['action_id'],
            ]);

            $likeCount = Like::where('action_id', $validated['action_id'])->count();

            return response()->json([
                'status' => 'success',
                'message' => 'Action liked successfully',
                'data' => [
                    'like_count' => $likeCount,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to like action',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Owner: Grace
     * PBI-03: Like System
     */
    public function destroy(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to unlike',
                'data' => null,
            ], 401);
        }

        $validated = $request->validate([
            'action_id' => 'required|integer',
        ]);

        $like = Like::where('user_id', auth()->id())
            ->where('action_id', $validated['action_id'])
            ->first();

        if (!$like) {
            return response()->json([
                'status' => 'error',
                'message' => 'Like not found',
                'data' => null,
            ], 404);
        }

        $like->delete();

        $likeCount = Like::where('action_id', $validated['action_id'])->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Action unliked successfully',
            'data' => [
                'like_count' => $likeCount,
            ],
        ]);
    }

    /**
     * Owner: Grace
     * PBI-03: Like System
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

        $likes = Like::where('user_id', auth()->id())
            ->get()
            ->map(function ($like) {
                return [
                    'action_id' => $like->action_id,
                ];
            });

        return response()->json([
            'status' => 'success',
            'message' => 'User likes retrieved successfully',
            'data' => $likes,
        ]);
    }

    /**
     * Owner: Grace
     * PBI-03: Like System
     */
    public function count($actionId)
    {
        $likeCount = Like::where('action_id', $actionId)->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Like count retrieved successfully',
            'data' => [
                'action_id' => $actionId,
                'like_count' => $likeCount,
            ],
        ]);
    }
}
