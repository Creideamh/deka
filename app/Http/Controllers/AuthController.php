<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have successfully loggedin');
        }

        return redirect('deka-insurance')->withErrors('Ooops! Error encountered, invalid credentials');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/deka-insurance');
    }

    /**
     * Change Password
     */
    public function changePassword(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $request->validate([
            'current_password' => ['required'],
            'new_password' => 'required|different:current_password|min:8',
            'password_confirm' => 'required|same:new_password'
        ]);

        if (Hash::check($request->current_password, $user->password)) {

            $updated = User::find($user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->intended('user-profile')->withSuccess('Password changed successfully, logout to test');
        } else {
            return redirect('user-profile')->withErrors('Oops, Snap!, Always remember to take a deep breath');
        }
    }
}
