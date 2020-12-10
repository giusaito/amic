<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Team;


class TeamController extends FrontendController
{
    public function index(){
        $records = Team::orderBy('director', 'asc')->orderBy('id', 'desc')->paginate(12);
        return view('Frontend.Team.index', compact('records'));
    }
}
