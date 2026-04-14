<?php

namespace App\Helpers;

use App\Models\VideoLike;

class LikeHelper
{
    /**
     * Toggle like (like / unlike)
     */
    public static function toggle($videoId, $userId)
    {
        $like = VideoLike::where('video_id', $videoId)
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            $like->delete();
            $status = 'unliked';
        } else {
            VideoLike::create([
                'video_id' => $videoId,
                'user_id' => $userId
            ]);
            $status = 'liked';
        }

        // ✅ always return fresh count
        $count = VideoLike::where('video_id', $videoId)->count();

        return [
            'status' => $status,
            'count' => $count
        ];
    }

    /**
     * Get total likes
     */
    public static function count($videoId)
    {
        return VideoLike::where('video_id', $videoId)->count();
    }

    /**
     * Check if user liked
     */
    public static function isLiked($videoId, $userId)
    {
        return VideoLike::where('video_id', $videoId)
            ->where('user_id', $userId)
            ->exists();
    }
}