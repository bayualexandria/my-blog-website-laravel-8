<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('backend.auth.login', [
            'title' => 'Halaman Login'
        ]);
    }

    public function attemptLogin(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email harus diisi',
                'password.required' => 'Password harus diisi'
            ]
        );


        if (Auth::attempt($credentials, $request->remember_me)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('error', 'Email atau password yang anda masukan salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->to('/login')->with('success', 'Anda berhasil logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    // public function handleProviderCallback()
    // {

    //     try {
    //         $user = Socialite::driver('google')->user();
    //     } catch (\Exception $e) {
    //         return redirect('/login');
    //     }
    //     // only allow people with @company.com to login
    //     if (explode("@", $user->email)[1] !== 'company.com') {
    //         return redirect()->to('/');
    //     }
    //     // check if they're an existing user
    //     $existingUser = User::where('email', $user->email)->first();
    //     if ($existingUser) {
    //         // log them in
    //         // auth()->login($existingUser, true);
    //         Auth::login($existingUser);
    //     } else {
    //         // create a new user
    //         $newUser                  = new User;
    //         $newUser->name            = $user->name;
    //         $newUser->email           = $user->email;
    //         $newUser->google_id       = $user->id;
    //         $newUser->avatar          = $user->avatar;
    //         $newUser->avatar_original = $user->avatar_original;
    //         $newUser->save();
    //         // auth()->login($newUser, true);
    //         Auth::login($newUser);
    //     }
    //     return redirect()->to('/dashboard');

    // }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finderuser = User::where('google_id', $user->id)->first();
            if ($finderuser) {
                Auth::login($finderuser);
                return redirect()->intended('dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'avatar' => $user->avatar_original
                ]);
                Auth::login($newUser);

                return redirect()->route('login')->with('success', 'Selamat anda telah terdaftar');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
