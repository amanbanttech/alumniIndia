<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\State;


class UniversityProfileController extends Controller
{
    
    public function edit()
    {
        try {

            $pageTitle = 'University Profile';
            $university = University::with(['user', 'states'])->where('user_id', Auth::id())->firstOrFail();
            $states = State::orderBy('name')->get();

            $currentStateId = optional($university->states->first())->id;



            return view('university.universityProfile.universityProfile', compact('pageTitle', 'university', 'states', 'currentStateId'));
        } catch (Exception $e) {
            return back()->with('error', 'Unable to load profile page.');
        }
    }

    public function update(Request $request, $id)
    {
        $university = University::with('user')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $university->user->id,
            'state_id' => 'required|exists:states,id',
            'city' => 'required|string|max:255',
            'phoneNumber' => 'required|digits:10|unique:users,phoneNumber,' . $university->user->id,
            'about' => 'required|string|max:255',
            'address' => 'required|string',
            'emblem_logo' => 'nullable|file|mimes:webp|max:2048',
        ], [
                'state_id.required' => 'The state field is required.',
                'state_id.exists' => 'Please select a valid state.',
            ]);

        

        DB::beginTransaction();

        try {

            $emblemFileName = $university->user->image;
            if ($request->hasFile('emblem_logo')) {
                if ($emblemFileName && file_exists(public_path('university_assets/images/' . $emblemFileName))) {
                    unlink(public_path('university_assets/images/' . $emblemFileName));
                }

                $emblemFileName = uniqid() . '.' . $request->file('emblem_logo')->extension();
                $request->file('emblem_logo')->move(
                    public_path('university_assets/images'),
                    $emblemFileName
                );
            }

            $university->user->update([
                'name' => $request->name,
                'phoneNumber' => $request->phoneNumber,
                'email' => $request->email,
                'image' => $emblemFileName,
            ]);

            

            $university->update([
                'city' => $request->city,
                'about' => $request->about,
                'address' => $request->address,
            ]);

            DB::table('university_states')
                ->where('university_id', $university->id)
                ->update([
                    'state_id' => $request->state_id,
                ]);

            DB::commit();

            return back()->with('success', 'University Profile updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('University Profile Update Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

}
