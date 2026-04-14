<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminPrivacyPolicycontroller extends Controller
{
    public function edit()
    {
        try {
            $pageTitle = 'Privacy Policy';

            $privacyPolicy = DB::table('privacy_policy')->first();

            return view('admin.privacyPolicy.edit', compact('pageTitle', 'privacyPolicy'));

        } catch (\Exception $e) {
            Log::error('Error fetching Privacy Policy data: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while fetching the Privacy Policy data.');
        }
    }


    public function update(Request $request)
    {
        $validated = $request->validate(
            [
                'text' => 'required',

            ],
            [
                'text.required' => 'Privacy Policy field is required',

            ]
        );

        DB::beginTransaction();

        try {
            $privacyPolicy = DB::table('privacy_policy')->update(['text' => $request->text]);

            DB::commit();

            return redirect()->back()->with('success', 'Privacy Policy Updated Successfully');

        } catch (\Exception $e) {
            DB::rollBack(); 
            Log::error('Error updating Privacy Policy: ' . $e->getMessage(), [
                'text' => $request->text,
                'textEn' => $request->textEn,
            ]);

            return back()->with('error', 'An error occurred while updating the Privacy Policy.');
        }
    }

}
