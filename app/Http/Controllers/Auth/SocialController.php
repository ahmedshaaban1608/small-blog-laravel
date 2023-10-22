<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToGithub(Request $request)
    {
        
            return Socialite::driver('github')->redirect();

    }

    public function handleGithubCallback()
    {
        
        $githubUser = Socialite::driver('github')->user();
        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name? $githubUser->name: $githubUser->nickname,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
            'password' => $githubUser->id.$githubUser->nickname,
        ]);
     
        Auth::login($user);
        $token = $user->createToken('MyAppToken')->plainTextToken;
        return redirect('/home');

        // Here you can handle the user data, create an account, and log them in.
    }

    public function redirectToGoogle(Request $request)
    {
        
        return Socialite::driver('google')->redirect();

    }

    public function handleGoogleCallback()
    {
        
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name? $googleUser->name: $googleUser->nickname,
            'email' => $googleUser->email,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
            'password' => $googleUser->id.'laravel',
        ]);
     
        Auth::login($user);
        $token = $user->createToken('MyAppToken')->plainTextToken;
        return redirect('/home');

        // Here you can handle the user data, create an account, and log them in.
    }

    
}
