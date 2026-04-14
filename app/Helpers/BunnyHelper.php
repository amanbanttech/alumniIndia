<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('uploadToBunny')) {
    function uploadToBunny($filePath, $fileName)
    {
        $storageZone = config('services.bunny.storage_zone');
        $apiKey = config('services.bunny.api_key');
        $region = config('services.bunny.region');

        $url = "https://{$region}.storage.bunnycdn.com/{$storageZone}/{$fileName}";

        $response = Http::withHeaders([
            'AccessKey' => $apiKey,
            'Content-Type' => 'application/octet-stream',
        ])->withBody(
                file_get_contents($filePath),
                'application/octet-stream'
            )->put($url);

        return $response->successful();
    }

    function deleteFromBunny($fileName)
    {
        $storageZone = config('services.bunny.storage_zone');
        $apiKey = config('services.bunny.api_key');
        $region = config('services.bunny.region');

        $url = "https://{$region}.storage.bunnycdn.com/{$storageZone}/{$fileName}";

        Http::withHeaders([
            'AccessKey' => $apiKey,
        ])->delete($url);
    }


}