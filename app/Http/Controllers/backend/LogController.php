<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Crypt;
use Auth;

class LogController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $loginUser = Auth::user();
            if($loginUser->role_id == 1 || $loginUser->role_id == 2){
        $logs = DB::select('SELECT l.*, c.name as category_name, i.item_code as item_code 
                            from log as l
                            join items as i
                            on l.items_id = i.id
                            join categories as c
                            on i.categories_id = c.id');
        $users = DB::select('SELECT * from users where deleted_at is null');


        return view('backend_v2.log.log')
            ->with('logs', $logs)
            ->with('users',$users);


    }
    else{
        return action('/unauthorize');
    }
    }
}

