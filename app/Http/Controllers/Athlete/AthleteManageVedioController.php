<?php

namespace App\Http\Controllers\Athlete;
use App\Models\OtpValidation;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Degree;
use App\Models\Board;
use App\Models\DiplomaBoard;
use App\Models\AthleteDocument;
use App\Models\DiplomaStream;
use App\Models\Sport;
use App\Models\TwelfthStream;
use App\Models\Athlete;
use App\Models\AthleteVideo;
use Illuminate\Support\Facades\Validator;
use App\Jobs\UploadVideoJob;


class AthleteManageVedioController extends Controller
{



    // ================= MANAGE VIDEOS =================
    public function manageVideo(Request $request)
    {
        $pageTitle = 'Manage Videos';

        try {
            $athleteId = Auth::user()->athlete->id;
            $query = AthleteVideo::where('athlete_id', $athleteId);

            if ($request->search) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('about', 'like', '%' . $request->search . '%')
                        ->orWhere('visibility', 'like', '%' . $request->search . '%');
                });
            }

            $videos = $query->latest()->paginate(10);

            if ($request->ajax()) {
                return view('athlete.manageVideos.manageVideoList', compact('pageTitle', 'videos'))->render();
            }

            return view('athlete.manageVideos.manageVideoList', compact('pageTitle', 'videos'));
        } catch (\Exception $e) {

            //  Log Error
            Log::error('Video Manage Error', [
                'message' => $e->getMessage(),
            ]);

            //  Show Friendly Message
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function addVideo(Request $request)
    {
        $pageTitle = 'Add Video';

        try {

            return view('athlete.manageVideos.addVideo', compact('pageTitle'));
        } catch (\Exception $e) {

            //  Log Error
            Log::error('Video Add Error', [
                'message' => $e->getMessage(),
            ]);

            //  Show Friendly Message
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    // public function storeVideo(Request $request)
    // {
    //     $athlete = Auth::user()->athlete;
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|string|max:255',
    //         'about' => 'required|string',
    //         'video' => 'required|mimes:mp4,mov,avi,wmv,webm|max:51200',
    //         'visibility' => 'required|in:active,inactive',
    //     ]);



    //     if ($validator->fails()) {
    //         return back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     //  Custom Membership Validation

    //     if ($athlete->membership == 'free') {

    //         $videoCount = AthleteVideo::where('athlete_id', $athlete->id)
    //             ->where('status', 'done')
    //             ->count();

    //         if ($videoCount >= 10) {
    //             return back()
    //                 ->withErrors([
    //                     'membership' => 'You have reached the maximum limit of 10 videos under free membership. Please upgrade to elite-membership to upload more videos.'
    //                 ])
    //                 ->withInput();
    //         }
    //     }

    //     try {

    //         $extension = $request->file('video')->getClientOriginalExtension();
    //         // $videoName = time() . '.mp4';
    //         $videoName = time() . '.' . $extension;
    //         $tempPath = $request->file('video')->move(public_path('uploads/athlete_assets'), $videoName);

    //         $video = AthleteVideo::create([
    //             'title' => $request->title,
    //             'about' => $request->about,
    //             'video' => $videoName,
    //             'athlete_id' => $athlete->id,
    //             'status' => 'processing',
    //             'visibility' => $request->visibility,
    //         ]);

    //         // UploadVideoJob::dispatch($video->id, $tempPath);
    //         $video->status = 'done';
    //         $video->progress = 100;
    //         $video->save();

    //         return redirect()->route('athlete.manage-videos')
    //             ->with('success', 'Video added successfully');

    //     } catch (\Exception $e) {
    //         Log::error('Video Store Error', [
    //             'message' => $e->getMessage(),
    //         ]);
    //         return back()->with('error', 'Something went wrong.');
    //     }
    // }

    public function storeVideo(Request $request)
    {
        $athlete = Auth::user()->athlete;

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'about' => 'required|string',
            'video' => 'required|mimes:mp4,webm|max:51200',
            'visibility' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //  Membership validation
        if ($athlete->membership == 'free') {

            $videoCount = AthleteVideo::where('athlete_id', $athlete->id)
                ->where('status', 'done')
                ->count();

            if ($videoCount >= 10) {
                return back()
                    ->withErrors([
                        'membership' => 'You have reached the maximum limit of 10 videos under free membership. Please upgrade to elite-membership to upload more videos.'
                    ])
                    ->withInput();
            }
        }

        try {

            //  File get
            $file = $request->file('video');

            //  Unique name
            $videoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            //  Temp path
            $tempPath = $file->getRealPath();



            $upload = uploadToBunny($tempPath, $videoName);

            //  Upload fail
            if (!$upload) {
                return back()->with('error', 'Video upload failed to CDN.');
            }

            //  Save DB
            $video = AthleteVideo::create([
                'title' => $request->title,
                'about' => $request->about,
                'video' => $videoName,
                'athlete_id' => $athlete->id,
                'status' => 'done',
                'progress' => 100,
                'visibility' => $request->visibility,
            ]);

            return redirect()->route('athlete.manage-videos')
                ->with('success', 'Video added successfully.');

        } catch (\Exception $e) {

            Log::error('Video Store Error', [
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Something went wrong.');
        }
    }
    public function editVideo($id)
    {
        $pageTitle = 'Edit Video';

        try {

            $athlete = Auth::user()->athlete;

            $video = AthleteVideo::where('id', $id)
                ->where('athlete_id', $athlete->id)
                ->firstOrFail();

            return view('athlete.manageVideos.editVideo', compact('pageTitle', 'video'));

        } catch (\Exception $e) {

            Log::error('Video Edit Error', [
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function updateVideo(Request $request, $id)
    {
        $athlete = Auth::user()->athlete;

        $video = AthleteVideo::where('id', $id)
            ->where('athlete_id', $athlete->id)
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'about' => 'required|string',
            'video' => 'nullable|mimes:mp4,webm|max:51200',
            'visibility' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            // Basic Fields Update
            $video->title = $request->title;
            $video->about = $request->about;
            $video->visibility = $request->visibility;

            // If New Video Uploaded
            if ($request->hasFile('video')) {

                $file = $request->file('video');
                // $videoName = time() . '.mp4';
                $videoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $tempPath = $file->getRealPath();

                $upload = uploadToBunny($tempPath, $videoName);
                if (!$upload) {
                    return back()->with('error', 'Video upload failed to CDN.');
                }

                //  OLD VIDEO delete from Bunny (optional but recommended)
                deleteFromBunny($video->video);

                $video->video = $videoName;
                $video->status = 'done';
                $video->progress = 100;   // important

                $video->save();

                // UploadVideoJob::dispatch($video->id, $tempPath);

                return redirect()->route('athlete.manage-videos')
                    ->with('success', 'Video updated successfully.');
            }

        } catch (\Exception $e) {

            Log::error('Video Update Error', [
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Something went wrong.');
        }
    }

    public function deleteVideo(Request $request)
    {
        $request->validate([
            'video_id' => 'required|integer|exists:athlete_videos,id',
        ]);

        try {

            $athleteId = Auth::user()->athlete->id;

            // Find video belonging to logged-in athlete
            $video = AthleteVideo::where('id', $request->video_id)
                ->where('athlete_id', $athleteId)
                ->firstOrFail();

            // Delete from bunny cdn folder
            deleteFromBunny($video->video);

            // $filePath = public_path('uploads/athlete_assets/' . $video->video);

            // if (file_exists($filePath)) {
            //     unlink($filePath);
            // }

            // Delete DB record
            $video->delete();

            return redirect()->back()->with('success', 'Video deleted successfully!');

        } catch (\Exception $e) {

            Log::error('Video Delete Error', [
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function videoProgress($id)
    {
        try {

            $video = AthleteVideo::find($id);

            if (!$video) {
                return response()->json([
                    'progress' => 0,
                    'status' => 'not_found'
                ]);
            }

            return response()->json([
                'progress' => $video->progress ?? 0,
                'status' => $video->status,
                'video' => $video->video   // ye add karo
            ]);

        } catch (\Exception $e) {

            Log::error('Video Progress Error', [
                'message' => $e->getMessage(),
                'video_id' => $id
            ]);

            return response()->json([
                'progress' => 0,
                'status' => 'error'
            ]);
        }
    }
}
