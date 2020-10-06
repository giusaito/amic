<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Project;
use App\Http\Models\ProjectEdition;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Response;

class ProjectEditionController extends Controller
{
    public function index(){
        return view('Backend.Projetos.edicoes_index');
    }
    public function show($busca = false){
    }
    public function create(Request $request, $id)
    {
        $projeto = Project::where('id', $id)->first();
        return view('Backend.Projetos.edicoes_create')->with('projeto', $projeto);
    }
    public function store(Request $request)
    {
    }
}