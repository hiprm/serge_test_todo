<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->header('token');
        $user_id = User::where('api_token',$token)->get()[0]['id'];

        $list=ToDo::where('user_id',$user_id)->get();
        $json['status'] = 'SUCCESS';
        $status_code = 200;
        $json['info'] = array("status" => $status_code, "data" => $list);

        return response()->json($json, $status_code);

    }

    public function show(Request $request)
    {

        $list=ToDo::where('id',$request->id)->get();
        $json['status'] = 'SUCCESS';
        $status_code = 200;
        $json['info'] = array("status" => $status_code, "data" => $list);

        return response()->json($json, $status_code);
    }

    public function store(Request $request)
    {
        $token = $request->header('token');

        $post_data = $request->all();
        $validator = Validator::make($post_data, [
            "todo" => "required|string",
        ]);
        if ($validator->passes()) {
            $json = array();
            try {

               $user_id = User::where('api_token',$token)->get()[0]['id'];
                $new_todo = ToDo::create([
                    'todo' => $request->todo,
                    'user_id' =>$user_id
                ]);

                $json['status'] = 'SUCCESS';
                $status_code = 201;
                $json['info'] = array("status" => $status_code, "data" => $new_todo);

            } catch (\Exception $error) {
                $json['status']  = 'ERROR';
                $status_code = 500;
                $json['info']  = array("status" => $status_code, "error" => $error->getMessage());

            }
        } else {
            $json['status']  = 'ERROR';
            $status_code = 400;
            $json['info']  = array("status" => $status_code, "error" => $validator->errors()->all());

        }
        return response()->json($json, $status_code);

    }

    public function update(Request $request)
    {

        $post_data = $request->all();
        $validator = Validator::make($post_data, [
            "todo" => "string",
            "status" => "integer"
        ]);
        if ($validator->passes()) {
            $json = array();
            try {
                $arr =  ['updated_at' =>  Carbon::now('Asia/Colombo')->format('Y-m-d H:i:s')];
                if($request->todo){
                    $arr['todo'] =$request->todo;
                }
                if ($request->status){
                    $arr['status'] = $request->status;
                }

                $store_status=  ToDo::where('id', $request->id)
                    ->update($arr);

                $json['status'] = 'SUCCESS';
                $status_code = 200;
                $json['info'] = array("status" => $status_code, "data" => $store_status);

            } catch (\Exception $error) {
                $json['status']  = 'ERROR';
                $status_code = 500;
                $json['info']  = array("status" => $status_code, "error" => $error->getMessage());

            }
        } else {
            $json['status']  = 'ERROR';
            $status_code = 400;
            $json['info']  = array("status" => $status_code, "error" => $validator->errors()->all());

        }
        return response()->json($json, $status_code);

    }

    public function delete(Request $request)
    {
        $todo = ToDo::find($request->id);

        $todo->delete();
        $json = array();
        $json['status'] = 'SUCCESS';
        $status_code = 204;
        $json['info'] = array("status" => $status_code, "data" => "DELETED SUCCESS");

        return response()->json($json, $status_code);
    }
}
