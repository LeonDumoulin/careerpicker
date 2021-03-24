<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Technological;
use Illuminate\Http\Request;

class TechnologicalController extends Controller
{
    //

    public $helper;
    public $model;
    public $guard ;
    public function __construct()
    {
        $this->guard = 'api';
        $this->helper = new Helper();
        $this->model = new Technological();
    }

public function index(Request $request)
    {
        $faculty = $this->model->where(function($q) use($request){
        if($request->fld_id)
        {
        $q->whereHas('field',function($q) use($request){
        		$q->where('id',$request->fld_id);
        });
        }
       
        })->with('field')->get();
        return $this->helper->responseJson(1,'تمت العمليه بنجاح',$faculty);

    }

    public function Add(Request $request)
    {

        $rules =
            [
                'name' => 'required',
                'des' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'field_id' => 'required|exists:fields,id'
            ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return $this->helper->responseJson(0, $data->errors()->first());
        }

        $record = $this->model->create($request->all());
        if ($request->hasFile('image')) {
            if ($request->file('image')->getSize() < (5 * 1024 * 1024)) {
                $filename = hash_hmac('sha256', hash_hmac('sha256', preg_replace('/\\.[^.\\s]{3,4}$/', '', $request->image), false), false);
                $file_name = $request->image->getClientOriginalName();
                $extn = $request->image->getClientOriginalExtension();
                $mime = $request->image->getClientMimeType();
                $final = $filename . '.' . $extn;
                $file = $request->image->storeAs('', $final, 'public');
                $record->image = $file;
                $record->save();
            }
        }
        return $this->helper->responseJson(1, 'تم الاضافه بنجاح',$record);
    }


    public function update(Request $request)
    {

        $rules =
            [
                'id' => 'required|exists:technologicals,id',
                'name' => 'required',
                'des' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'field_id' => 'required|exists:fields,id'
            ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return $this->helper->responseJson(0, $data->errors()->first());
        }

        $update = $this->model->findOrFail($request->id);
        if ($request->hasFile('image')) {
            $filename = public_path('storage/'.$update->image);

            if (file_exists($filename)) {
                unlink($filename);
            }
            $filename = hash_hmac('sha256', hash_hmac('sha256', preg_replace('/\\.[^.\\s]{3,4}$/', '', $request->image), false), false);
            $file_name = $request->image->getClientOriginalName();
            $extn = $request->image->getClientOriginalExtension();
            $mime = $request->image->getClientMimeType();
            $final = $filename . '.' . $extn;
            $file = $request->image->storeAs('', $final, 'public');
            $update->image = $file;


            $update->save();
        }
        $update->update($request->except('image'));

        return $this->helper->responseJson(1, 'تم التحديث بنجاح',$update);

    }

    public function delete(Request $request)
    {
        $rules =
            [
                'id' => 'required|exists:technologicals,id',
            ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return $this->helper->responseJson(0, $data->errors()->first());
        }

        $delete = $this->model->findOrFail($request->id);


        $filename = public_path('storage/'.$delete->image);



        if ($delete){
            if (file_exists($filename)) {
                unlink($filename);

            }
            $delete->delete();
            return $this->helper->responseJson(1, 'تم الحذف بنجاح');
        }

    }
}
