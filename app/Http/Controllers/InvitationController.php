<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function showAcceptForm($token)
    {
        $user = User::where('invitation_token', $token)->firstOrFail();

        return view('auth.accept-invitation', ['user' => $user]);
    }

    public function accept(Request $request, $token)
    {
        $user = User::where('invitation_token', $token)->firstOrFail();

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->invitation_token = null; // invalidate the token
        $user->email_verified_at = now();
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome to your account!');
    }
}
