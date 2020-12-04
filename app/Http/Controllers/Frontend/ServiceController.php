<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Service;

class ServiceController extends Controller
{
    public function index(){
        $service = Service::orderBy('id', 'desc')->get();
    }

    public function view($slug){
        $service = Service::where('slug', $slug)->first();
    }
}
