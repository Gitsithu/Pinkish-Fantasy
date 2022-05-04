<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Core\ReturnMessage as ReturnMessage;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {



        try {
            $inputs = Input::all();
            $request_conditions = isset($inputs['conditions']) ? $inputs['conditions'] : null;
            $raw_conditions = json_decode($request_conditions);

            $conditions = array();
            foreach ($raw_conditions as $key => $value) {
                $raw_data = $value;
            }

            // getting data by array format
            

            $result_array = array();
            $result_array['result_array'] = $raw_data;

            $raw_objs = $raw_data;
            

            $item_list = '<img src="'. $raw_data .'" style="width:100%;height:100%;" />';



            $returned_obj['objs'] = $item_list;

            $returned_obj['status_code'] = ReturnMessage::OK;
            $returned_obj['status_message'] = "Syncs down process completed successfully !";
            $returned_obj['data'] = $result_array;


            return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::OK);
        } catch (\Exception $e) {
            $returned_obj['status_code'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returned_obj['status_message'] = $e->getMessage();
            $returned_obj['data'] = array();
            $returned_obj['objs'] = "";

            return response()->json(array('returned_obj'=> $returned_obj), ReturnMessage::INTERNAL_SERVER_ERROR);
        }
        }
    
}