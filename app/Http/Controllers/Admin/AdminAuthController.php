<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function loginView()
    {
        try {
            return view('admin.auth.login');
        } catch (Exception $e) {
            Log::error('Failed to open login page: ' . $e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong! Please try again.');
        }
    }



    public function loginSubmit(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {


            $credentials = $request->only('email', 'password');


            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                //  Account deactivate check
                if ($user->account_status == 0) {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Your account is deactivated. Please contact admin.');
                }

                if (Auth::user()->role_id == '1') {
                    return redirect()->route('admin.dashboard');
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'login failed. Please enter valid login credentials.');
                }
            }

            return redirect()->back()->withInput()->with('error', 'Login failed. Please enter valid login credentials.');
        } catch (Exception $e) {
            // dd($e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong! Please try again.');
        }
    }



    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login.view')->with('success', 'Logged out successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Logout failed. Try again.');
        }
    }

    public function forgotPasswordView()
    {
        try {
            return view('admin.auth.forgotPassword');
        } catch (Exception $e) {
            Log::error('Failed to open forget page: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function forgotPasswordSubmit(Request $request)
    {


        $request->validate([
            'email' => 'required|email'
        ]);

        try {

            //verify that it's admin mail or not , if not show error if than send mail.
            $user = User::where('email', $request->email)
                ->where('role_id', 1)
                ->first();

            if (!$user) {
                return back()->with('error', "We couldn't find an Admin account associated with this email address.");
            }

            $token = Str::random(64);

            DB::table('password_resets')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );

            Mail::send('email.resetPassword', [
                'token' => $token,
                'name' => $user->name,
                'email' => $user->email
            ], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Admin Password Reset Request');
            });

            return redirect()->back()->with('success', 'A password reset link has been sent to your registered email address. Please check your inbox or spam folder.');
        } catch (Exception $e) {
            Log::error('Failed to send password reset email: ' . $e->getMessage());
            return back()->with('error', 'Failed to send password reset link.');
        }
    }

    public function resetPasswordView($token)
    {
        $resetPassword = DB::table('password_resets')->where('token', $token)->first();

        if (!$resetPassword) {

            return redirect()->route('admin.forgot.password.view')->with('error', 'Invalid token. Please try again.');
        }
        return view('admin.auth.resetPassword', ['token' => $token]);

    }

    public function resetPasswordSubmit(Request $request)
    {


        $request->validate([
            'password' => 'required|regex:/[@$!%*#?&]/|regex:/[A-Z]/|min:6',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => 'New Password field is required',
            'password_confirmation.required' => 'Confirm Password field is required',
            'password_confirmation.same' => 'New Password and Confirm Password must be same.',
            'password.regex' => 'Password must be at least 8 characters long and include uppercase letters, lowercase letters, numbers, and special characters.',
        ]);
        try {

            $reset = DB::table('password_resets')
                ->where('token', $request->token)
                ->first();

            if (!$reset) {
                return back()->with('error', 'Invalid or expired reset link.');
            }

            $user = User::where('email', $reset->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            DB::table('password_resets')->where('token', $request->token)->delete();

            return redirect()->route('admin.login.view')->with('success', 'Password updated successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Unable to reset password. Try again.');
        }
    }
}
