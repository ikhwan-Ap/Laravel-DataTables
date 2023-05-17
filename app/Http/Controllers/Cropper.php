<?php

namespace App\Http\Controllers;

use App\Models\Cropper as ModelsCropper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Cropper extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Cropper'
        ];
        return view('admin.cropper.index', $data);
    }

    public function get_data_cropper(Request $request)
    {
        $cropper = new  ModelsCropper;
        if ($request->getMethod(true) == 'POST') {
            $list = $cropper->query();
            if ($request->has('search')) {
                $list->where('name', 'LIKE', '%' . $request->search['value'] . '%');
                $list->orWhere('description', 'LIKE', '%' . $request->search['value'] . '%');
            }
            $list->limit(10);
            if ($request->has('length')) {
                $list->skip($request->input('start'));
                $list->take($request->input('length'));
            }
            if ($request->status == 'archieved') {
                $list->onlyTrashed();
            }
            $list =  $list->get();
            $row = array();
            $no = $request->start;
            $no = 1;
            foreach ($list as $item) {
                $action = '
                <button type="submit" data-id=' . $item->id . ' class="btn btn-danger btnDel" title="DELETE">
                    <span class="ion ion-ios-trash">
                    </span>
                </button>

                <button type="button" class="btn btn-light btnEdit" data-id="' . $item->id . '"  title="EDIT">
                     <span class="ion ion-gear-a"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $item->name,
                    $item->description,
                    url("/img/cropper/$item->image"),
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $cropper->count(),
                'recordsFiltered' => $cropper->count(),
                'data' => $row
            ];
            echo json_encode($output);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failled get data'
            ];
            echo json_encode($response);
        }
    }

    public function store(Request $request)
    {
        $rules     = ['name' => 'required', 'description' => 'required', 'base_64_cropper' => 'required'];
        $message   = ['required' => ':attribute  Harus Di Isi !.'];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            $response = [
                'status'  => 'error_validation',
                'message' => $validator->errors()->all(),
            ];
            return $response;
        }
        $image_cropper = $request->input('base_64_cropper');
        $image_array_1 = explode(";", $image_cropper);
        $image_array_2 = explode(",", $image_array_1[1]);
        $ext           = explode("/", $image_array_1[0]);

        $image        = base64_decode($image_array_2[1]);
        $nama_image   = 'Cropper-' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext[1];
        $image_name   = '../public/img/cropper/' . $nama_image;
        $upload_image = file_put_contents($image_name, $image);
        if (!$upload_image) {
            $response = [
                'status'  => 'error',
                'message' => 'Image Gagal Di Upload'
            ];
            return $response;
        }
        $cropper = new ModelsCropper();
        $cropper->name        = $request->input('name');
        $cropper->description = $request->input('description');
        $cropper->image       = $nama_image;
        $save                 = $cropper->save();
        if (!$save) {
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
}
