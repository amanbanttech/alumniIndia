<?php
namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Sport;
use App\Models\UniversitySport;
use App\Models\OtpValidation;
use Illuminate\Support\Facades\Validator;
use App\Models\State;
use App\Http\Controllers\Admin\OtpTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use Exception;

class ManageSportController extends Controller
{

    public function sportlist()
    {
        try {

            $pageTitle = 'Manage Sports';

            $university = auth()->user()->university;
            $university->load('sports');
            return view('university.sports.manageSports', compact('pageTitle', 'university'));
        } catch (Exception $e) {
            return back()->with('error', 'Unable to load sports list page.');
        }
    }

    public function add()
    {
        try {
            $pageTitle = 'Add Sport';
            $generalsports = Sport::all();

            return view('university.sports.addSports', compact('pageTitle', 'generalsports'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Unable to load add sport page.');
        }
    }


    public function store(Request $request)
    {
        $university = auth()->user()->university;

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
                'regex:/^[A-Za-z ]+$/',

                Rule::unique('university_sports')->where(function ($q) use ($university) {
                    return $q->where('university_id', $university->id);
                }),
            ],
            'category' => 'required|in:indoor,outdoor',
        ],
        [
            'name.regex' => 'The name may only contain letters and spaces.',
            'name.unique' => 'This sport already exists for your university.',
            'name.required' => 'The Sport name field is required.',
            'category.required' => 'The Sport category field is required',
        ]);
        try {


            UniversitySport::create([
                'university_id' => $university->id,
                'name' => ucfirst($request->name),
                'category' => $request->category,
            ]);

            return redirect()->route('university.sport.list')->with('success', 'Sport added successfully');

        } catch (\Exception $e) {

            // Log real error for debugging
            Log::error('Sport Store Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = 'Edit Sport';
            $generalsports = Sport::all();

            $sport = UniversitySport::where('id', $id)
                ->where('university_id', auth()->user()->university->id)
                ->firstOrFail();

            return view('university.sports.editSport', compact('sport', 'pageTitle', 'generalsports'));

        } catch (\Exception $e) {
            return redirect()
                ->route('university.sport.list')
                ->with('error', 'Unauthorized or sport not found.');
        }
    }


    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
                'regex:/^[A-Za-z ]+$/',
                Rule::unique('university_sports')
                    ->where(
                        fn($q) =>
                        $q->where('university_id', auth()->user()->university->id)
                    )
                    ->ignore($id),
            ],
            'category' => 'required|in:indoor,outdoor',
        ],
        [
            'name.regex' => 'The name may only contain letters and spaces.',
            'name.unique' => 'This sport already exists for your university.',
            'name.required' => 'The Sport name field is required.',
            'category.required' => 'The Sport category field is required',
        ]);

        try {

            // Find sport
            $sport = UniversitySport::where('id', $id)
                ->where('university_id', auth()->user()->university->id)
                ->firstOrFail();
            // Update
            $sport->update([
                'name' => $request->name,
                'category' => $request->category,
            ]);

            return redirect()
                ->route('university.sport.list')
                ->with('success', 'Sport updated successfully.');

        } catch (\Exception $e) {

            \Log::error('Sport Update Error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while updating sport.');
        }
    }

}