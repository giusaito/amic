<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
\Carbon\Carbon::setLocale('pt_BR');

class HomeController extends FrontendController
{
	public function __construct(){
    	parent::__construct();
    	 $this->now = Carbon::now()->toDateTimeString();

    }

    public function index(){
    	return view('Frontend.Home.index');
    }
}
