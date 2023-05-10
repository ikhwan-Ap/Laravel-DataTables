<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }

    public function store(Request $request)
    {
        $rules     = ['password' => 'required', 'username' => 'required'];
        $message   = ['required' => ':attribute  Harus Di Isi !.'];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return response()
                ->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $user = DB::table('users')->where('username', $request->username)->get()->first();
        // if (!$user) {
        //     return response()->json(['status' => 'error', 'message' => 'User Tidak Ditemukan']);
        // }
        if (!Auth::attempt($request->except(['_token']))) {
            return response()->json(['status' => 'error', 'message' => 'Login Gagal Password Salah']);
        }

        Session::put('id', $user->id);
        Session::put('username', $user->username);
        Session::put('email', $user->email);
        return response()->json(['status' => 'success', 'message' => 'Anda Berhasil Login']);
    }

    public function logout()
    {
        Auth::logout();
        $response = [
            'status'  => 'success',
            'message' => 'Anda Berhasil Logout'
        ];
        return $response;
    }
}
