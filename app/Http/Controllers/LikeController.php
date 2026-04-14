<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoLike;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function toggleVideoLike(Request $request)
    {
        $userId = auth()->id();
        $videoId = $request->video_id;

        // 🔍 check already liked
        $like = VideoLike::where('user_id', $userId)
            ->where('video_id', $videoId)
            ->first();

        if ($like) {
            $like->delete();
            $status = 'unliked';
        } else {
            VideoLike::create([
                'user_id' => $userId,
                'video_id' => $videoId
            ]);
            $status = 'liked';
        }

        // 🔢 updated count
        $count = VideoLike::where('video_id', $videoId)->count();

        return response()->json([
            'status' => $status,
            'count' => $count
        ]);
    }
}