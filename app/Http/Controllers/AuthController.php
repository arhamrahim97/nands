<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function cekLogin(Request $request)
    {
        if (($request->username == '') || ($request->password == '')) {
            return response()->json([
                'res' => 'inputan_tidak_lengkap',
            ]);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'res' => 'berhasil',
            ]);
        }

        return response()->json([
            'res' => 'gagal',
            'mes' => 'Nama Pengguna beserta Kata Sandi yang dimasukkan tidak ditemukan. Silahkan cek kembali inputan anda.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
