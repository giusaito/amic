<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Setting;
use Carbon\Carbon;
use View;


class FrontendController extends Controller
{
    public function __construct(){
    	$setting = Setting::find(1);

    	View::share ([
    		'setting' => $setting,
      	]);
    }
}
