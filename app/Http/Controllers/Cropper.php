<?php

namespace App\Http\Controllers;

use App\Models\Cropper as ModelsCropper;
use Illuminate\Http\Request;

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
        $cropper = ModelsCropper::get();
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
                    $item->image,
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
}
