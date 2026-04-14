<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class PolicyController extends Controller
{
    public function show()
    {
        try {
            $data = DB::table('privacy_policy')->first();

            if ($data) {
                return response()->json([
                    'status' => true,
                    'data' => $data
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'No Privacy Policy found.'
            ], 404);

        } catch (\Exception $e) {

            Log::error('Failed to fetch Privacy Policy.', [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.'
            ], 500);
        }
    }
}
