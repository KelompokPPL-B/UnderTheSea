<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class PointsService
{
    public const POINTS = [
        'ikan' => 5,
        'ekosistem' => 5,
        'aksi' => 3,
    ];

    public function awardPoints(int $userId, string $contentType, int $contentId): bool
    {
        try {
            DB::table('user_views')->insert([
                'user_id' => $userId,
                'content_type' => $contentType,
                'content_id' => $contentId,
            ]);

            $points = self::POINTS[$contentType] ?? 0;
            $user = User::find($userId);
            $user->increment('points', $points);
            $user->updateBadge();

            return true;
        } catch (\Exception $e) {
            // Duplicate entry - ignore
            return false;
        }
    }

    public function awardPointsForAction(int $userId, int $actionId): void
    {
        $user = User::find($userId);
        if ($user) {
            $user->increment('points', 10);
            $user->updateBadge();
        }
    }
}
