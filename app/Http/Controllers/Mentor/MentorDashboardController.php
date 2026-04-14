<?php

namespace App\Http\Controllers\Mentor;

use App\Models\VideoLike;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Athlete;

class MentorDashboardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Mentor Dashboard';

        $athletes = Athlete::with([
            'user',
            'nationality',
            'document',
            'videos.likes'
        ])->latest()->get();

        return view('mentor.index', compact('pageTitle', 'athletes'));
    }

    public function toggleLike(Request $request)
    {
        $videoId = $request->video_id;
        $userId = auth()->id();

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

        $count = VideoLike::where('video_id', $videoId)->count();

        return response()->json([
            'status' => $status,
            'count' => $count
        ]);
    }

    public function search(Request $request)
    {
        $search = strtolower($request->search);

        $athletes = Athlete::with([
            'user',
            'nationality',
            'document',
            'videos.likes'
        ])->latest()->get();

        $status = 'default';
        $allVideos = [];

        if ($search) {

            // 🔍 filter athletes by name
            $filtered = $athletes->filter(function ($ath) use ($search) {
                return str_contains(strtolower($ath->user->name ?? ''), $search);
            });

            // ================= CASE 3 =================
            if ($filtered->isEmpty()) {
                $status = 'no_athlete';
            } else {

                // 👉 sab matching athletes ki videos collect karo
                foreach ($filtered as $ath) {
                    foreach ($ath->videos as $v) {
                        $allVideos[] = [
                            'id' => $v->id,
                            'video' => $v->video,
                            'title' => $v->title,
                            'about' => $v->about,
                            'likes' => $v->likes->count(),
                            'liked' => $v->likes->where('user_id', auth()->id())->count() > 0,
                            'time' => $v->created_at->diffForHumans(),
                            'name' => $ath->user->name ?? 'N/A',
                            'country' => $ath->nationality->country_name ?? 'N/A',
                            'profile' => $ath->document->profile_photo ?? 'default.png'
                        ];
                    }
                }

                // ================= CASE 2 =================
                if (empty($allVideos)) {
                    $status = 'no_video';
                }

                // ================= CASE 1 =================
                else {
                    $status = 'has_video';
                }
            }
        }

        return view('mentor.index', compact(
            'athletes',
            'status',
            'allVideos' // 🔥 IMPORTANT
        ))->render();
    }
}
