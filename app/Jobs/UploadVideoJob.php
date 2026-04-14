<?php

namespace App\Jobs;

use App\Models\AthleteVideo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;

class UploadVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $videoId;
    public string $tempPath;

    public function __construct(int $videoId, string $tempPath)
    {
        $this->videoId = $videoId;
        $this->tempPath = $tempPath;
    }

    public function handle(): void
    {
        $video = AthleteVideo::find($this->videoId);

        if (!$video) {
            return;
        }

        try {

            $video->update([
                'status' => 'processing',
                'progress' => 0
            ]);

            $destination = 'uploads/athlete_assets/' . $video->video;

            FFMpeg::fromDisk('local')
                ->open($this->tempPath)
                ->export()
                ->onProgress(function ($percentage) {

                    AthleteVideo::where('id', $this->videoId)
                        ->update([
                            'progress' => $percentage
                        ]);

                })
                ->toDisk('public')
                ->inFormat(new X264)
                ->save($destination);

            $video->update([
                'status' => 'done',
                'progress' => 100
            ]);

            // delete temp video
            Storage::disk('local')->delete($this->tempPath);

        } catch (\Exception $e) {

            Log::error('Video Processing Failed', [
                'video_id' => $this->videoId,
                'error' => $e->getMessage()
            ]);

            $video->update([
                'status' => 'failed'
            ]);
        }
    }

    public function failed(\Throwable $e)
    {
        AthleteVideo::where('id', $this->videoId)
            ->update(['status' => 'failed']);
    }
}
