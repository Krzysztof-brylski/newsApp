<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogsController extends Controller
{

    public function index(){
        $logs=Logs::paginate(15);
//        return view('admin/log/index',['logs'=>$logs]);
    }


}
