<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Authentication extends Controller
{
    public function login(Request $request, User $user)
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

        if (!Auth::attempt($credentials, $request->remember_me)) {
            return response()->json(['error' => 'Email atau password salah', 'status' => 401], 401);
        }

        $data = $user->where('email', Auth::user()->email)->first();

        return response()->json(['data' => $data, 'status' => 200], 200, ['Authorization' => 'Bearer ' . $data->api_token]);
    }

    public function register(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ],
            [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email yang anda masukan tidak valid',
                'email.unique' => 'Email yang anda masukkan sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 6 karakter'
            ]
        );

        $user = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(60)
        ]);

        return response()->json([
            'data' => $user,
            'message' => 'Data has been created'
        ], 200);
    }
}
