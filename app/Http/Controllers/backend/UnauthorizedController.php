<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnauthorizedController extends Controller
{
    //
    public function unauthorize(){
        return view('backend_v2.unauthorize.unauthorize');
    }

}
