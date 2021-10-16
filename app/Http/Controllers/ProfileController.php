<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.profile', [
            'title' => 'Halaman Profile'
        ]);
    }

    public function profile(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required',
                'avatar' => 'image|file|max:1024'
            ],
            [
                'name.required' => 'Nama harus diisi',
                'avatar.image' => 'File yang anda masukan bukan gambar'
            ]
        );



        $data = $user->where('email', auth()->user()->email)->first();
        if ($request->file('avatar')) {

            $url_lama = parse_url(auth()->user()->avatar, PHP_URL_PATH);
            $str1 = ltrim($url_lama, "/");
            $str2 = ltrim($str1, "storage");
            $url = ltrim($str2, "/");
            Storage::delete($url);

            $avatar = url('storage/' . $request->file('avatar')->store('avatars'));
        } else {
            $avatar = $data->avatar;
        }


        $data->update([
            'name' => $request->name,
            'avatar' => $avatar
        ]);

        return redirect()->route('profile')->with('success', 'Profile telah diupdate');
    }

    public function password(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required',
            'conf_password' => 'required'

        ], [
            'password.required' => 'Password harus diisi',
            'conf_password.required' => 'Konfirmasi password harus diisi'
        ]);

        $data = $user->where('email', auth()->user()->email)->first();
        $data->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('profile')->with('success', 'Password telah diubah');
    }
}
