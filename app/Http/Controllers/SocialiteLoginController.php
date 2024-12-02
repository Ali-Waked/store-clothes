<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $provider_user =  Socialite::driver($provider)->user();
        // dd($provider,$provider_user->id);
        $user = User::where([
            'provider' => $provider,
            'provider_id' => $provider_user->id,
        ])->first();
        // dd($user);
        if (!$user) {
            $user = User::create([
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                'password' => Hash::make(Str::random(8)),
                'provider' => $provider,
                'provider_id' => $provider_user->id,
                'provider_token' => $provider_user->token,
            ]);
        }
        Auth::login($user);
        return redirect()->back();
    }
}
