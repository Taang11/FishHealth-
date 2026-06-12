<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $finduser = User::where('google_id', $user->id)
                            ->orWhere('email', $user->email)
                            ->first();

            if ($finduser) {
                // Update google_id if not set
                if (!$finduser->google_id) {
                    $finduser->update([
                        'google_id' => $user->id,
                        'avatar'    => $user->avatar,
                    ]);
                }
                
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else {
                $newUser = User::create([
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'google_id' => $user->id,
                    'avatar'    => $user->avatar,
                    'password'  => Hash::make(Str::random(16)),
                    'role'      => 'user',
                ]);

                // Send welcome email notification
                try {
                    \Illuminate\Support\Facades\Mail::to($newUser->email)->send(new \App\Mail\WelcomeMail($newUser));
                } catch (\Exception $e) {
                    \Log::error('Gagal mengirim email welcome Google: ' . $e->getMessage());
                }

                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (\Exception $e) {
            return redirect('login')->with('error', 'Gagal masuk menggunakan Google. Silakan coba lagi.');
        }
    }
}
