<?php

namespace App\Http\Controllers\University;

use App\Models\VideoLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Video;
use Exception;

class UniversityDashboardController extends Controller
{
    public function index()
    {
        try {
            $pageTitle = 'University Dashboard';

            $athletes = Athlete::with([
                'user',
                'nationality',
                'document',
                'videos.likes'
            ])->get();

            return view('university.index', compact('pageTitle', 'athletes'));
        } catch (Exception $e) {
            Log::error('Failed to load university dashboard: ' . $e->getMessage());

            return back()->with('error', 'Unable to load dashboard. Please try again later.');
        }
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

            //  filter athletes by name
            $filtered = $athletes->filter(function ($ath) use ($search) {
                return str_contains(strtolower($ath->user->name ?? ''), $search);
            });

            // ================= CASE 3 =================
            if ($filtered->isEmpty()) {
                $status = 'no_athlete';
            } else {

                //  sab matching athletes ki videos collect karo
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

        return view('university.index', compact(
            'athletes',
            'status',
            'allVideos' 
        ))->render();
    }

}
