<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Survey;
use Hash;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function custom_login(Request $request)
    {
        $request->validate([
            'email'     =>  'required|email',
            'password'  =>  'required'
        ], [
            'email.required' => 'Alamat email wajib di isi',
            'password.required' => 'Password wajib di isi',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                // 'redirect_url' => route('/')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data akun yang anda masukan salah'
        ]);
    }

    public function custom_registration(Request $request)
    {
        $register = new User();

        if ($request->type == 'merchant') {
            $register->name = $request->nama_perusahaan;
            $register->alamat = $request->alamat_perusahaan;
            $register->nomor_telepon = $request->nomor_telepon_perusahaan;
            $register->deskripsi = $request->deskripsi_perusahaan;
            $register->email = $request->email_perusahaan;
            $register->password = Hash::make($request->password_perusahaan);
            $register->type = $request->type;
        } else {
            $register->name = $request->name;
            $register->alamat = $request->alamat;
            $register->nomor_telepon = $request->nomor_telepon;
            $register->email = $request->email;
            $register->password = Hash::make($request->password);
            $register->type = $request->type;
        }

        $data = $register->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Registrasi akun berhasil, Silahkan login',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Registrasi akun gagal, silahkan cek ulang',
            ]);
        }
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
