<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserClientSide extends Controller
{
    public function index()
    {
        $data = [
            'title'        => 'Data User',
        ];
        return view('admin.user.index', $data);
    }

    public function get_data()
    {
        $user = new User();
        $user->query()->get();
        $data['users'] = $user;
        return $data;
        return view('admin.user_client_side.datalist');
    }

    public function store(Request $request)
    {
        $rules     = ['username' => 'required', 'email' => 'required', 'password' => 'required'];
        $message   = ['required' => ':attribute  Harus Di Isi !.'];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            $response = [
                'status'  => 'error_validation',
                'message' => $validator->errors()->all(),
            ];
            return $response;
        }

        $user = new User();
        $user->username   = $request->input('username');
        $user->email      = $request->input('email');
        $user->password   = Hash::make($request->input('password'));
        $save_user        = $user->save();

        if (!$save_user) {
            $response = [
                'status'  => 'error',
                'message' => 'Data User Gagal Di Tambah'
            ];
            return $response;
        }
        $response = [
            'status'  => 'success',
            'message' => 'Data User Berhasil Di Tambah'
        ];
        return $response;
    }

    public function destroy($id)
    {
        $id = User::find($id);
        $delete_user = $id->delete();
        if (!$delete_user) {
            $response = [
                'status'  => 'error',
                'message' => 'Data User Gagal Di Delete'
            ];
            return $response;
        }
        $response = [
            'status'  => 'success',
            'message' => 'Data User Berhasil Di Hapus'
        ];
        return $response;
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        if (!$data) {
            $response = [
                'status'  => 'error',
                'message' => 'Data User Tidak Di Temukan'
            ];
            return $response;
        }
        $response = [
            'data'    => $data,
            'status'  => 'success',
            'message' => 'Data User Berhasil Di Temukan'
        ];
        return $response;
    }
    public function update(Request $request, $id)
    {
        $rules     = ['username' => 'required', 'email' => 'required'];
        $message   = ['required' => ':attribute  Harus Di Isi !.'];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            $response = [
                'status'  => 'error_validation',
                'message' => $validator->errors()->all(),
            ];
            return $response;
        }
        $value = [
            'username'  => $request->username,
            'email'     => $request->email,
        ];
        if (isset($request->password)) {
            $value['password'] = Hash::make($request->password);
        }
        $update = User::where('id', $id)->update($value);
        if (!$update) {
            $response = [
                'status'  => 'error',
                'message' => 'Data User Gagal Di Update'
            ];
            return $response;
        }
        $response = [
            'status'  => 'success',
            'message' => 'Data User Berhasil Di Update'
        ];
        return $response;
    }

    public function update_password(Request $request, $id)
    {
        $rules     = ['password' => 'required'];
        $message   = ['required' => ':attribute  Harus Di Isi !.'];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            $response = [
                'status'  => 'error_validation',
                'message' => $validator->errors()->all(),
            ];
            return $response;
        }
        if (isset($request->password)) {
            $value['password'] = Hash::make($request->password);
        }
        $update = User::where('id', $id)->update($value);
        if (!$update) {
            $response = [
                'status'  => 'error',
                'message' => 'Password Gagal Di Update'
            ];
            return $response;
        }
        $response = [
            'status'  => 'success',
            'message' => 'Password Berhasil Di Update'
        ];
        return $response;
    }
}
