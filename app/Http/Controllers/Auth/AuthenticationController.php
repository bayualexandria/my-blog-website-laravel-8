<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

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
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Yang anda masukan bukan email',
                'password.required' => 'Password harus diisi'
            ]
        );
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->email_verified_at!=null) {      
                if (Auth::attempt($credentials, $request->remember_me)) {
                    $request->session()->regenerate();
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
                return back()->with('error', 'Password yang anda masukan salah!');
            }
            return redirect()->to('/email/verify');
        }
            return back()->with('error', 'Email yang anda masukan belum terdaftar!');
       
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

    public function register()
    {
        return view('backend.auth.register', ['title' => 'Halaman Register']);
    }

    public function attemptRegister(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|same:conf_pass|min:6',
                'conf_pass' => 'required|same:password|min:6'
            ],
            [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email yang anda masukkan sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.same' => 'Password tidak sama',
                'password.min' => 'Password minimal 6 karakter',
                'conf_pass.required' => 'Konfirmasi password harus diisi',
                'conf_pass.same' => 'Konfirmasi password tidak sama',
                'conf_pass.min' => 'Konfirmasi password minimal 6 karakter',
            ]
        );

        $users = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(60)
        ]);
        event(new Registered($users));

        $users->sendEmailVerificationNotification();

        return redirect()->to('/login')->with('success', 'Selamat anda berhasil registrasi! Silahkan verifikasi email anda');
    }
}
