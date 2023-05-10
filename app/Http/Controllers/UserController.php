<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title'        => 'Data User',
        ];
        return view('admin.user.index', $data);
    }

    public function get_data_user(Request $request)
    {
        $user = new User();
        if ($request->getMethod(true) == 'POST') {
            $list = $user->query();
            if ($request->has('search')) {
                $list->where('username', 'LIKE', '%' . $request->search['value'] . '%');
                $list->orWhere('email', 'LIKE', '%' . $request->search['value'] . '%');
            }
            $list->limit(10);
            if ($request->has('length')) {
                $list->skip($request->input('start'));
                $list->take($request->input('length'));
            }
            $list =  $list->get();

            $row = array();
            $no = $request->start;
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="submit" data-id=' . $hasil->id . ' class="btn btn-danger btnDel" title="DELETE">
                    <span class="ion ion-ios-trash">
                    </span>
                </button>

                <button type="button" class="btn btn-light btnEdit" data-id="' . $hasil->id . '"  title="EDIT">
                     <span class="ion ion-gear-a"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->username,
                    $hasil->email,
                    $action,
                ];
            }

            $output = [
                'recordsTotal' => $user->count(),
                'recordsFiltered' => $user->count(),
                'data' => $row
            ];
            echo json_encode($output);
        }
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
