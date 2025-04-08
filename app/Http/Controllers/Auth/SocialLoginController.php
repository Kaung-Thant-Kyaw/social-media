<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // login
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // callback
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $user = $this->findOrCreateUser($socialUser, $provider);
            Auth::login($user, true);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Login Failed: ' . $e->getMessage());
        }
    }

    // find | create social user
    public function findOrCreateUser($socialUser, $provider)
    {
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($socialAccount) {
            return $socialAccount->user;
        }

        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'avatar' => $socialUser->getAvatar(),
                'password' => null, // no need for social login
                'email_verified_at' => Carbon::now()
            ]);
        }

        // Create Social Account Relationship
        $user->socialAccounts()->create([
            'provider' => $provider,
            'provider_id' =>  $socialUser->getId(),
            'token' => $socialUser->token,
            'refresh_token' => $socialUser->refresh_token,
            'expired_at' => now()->addSeconds($socialUser->expiredIn),
        ]);

        return $user;
    }
}
