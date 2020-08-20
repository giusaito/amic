<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Project;
use Illuminate\Support\Str;
use Response;

class ProjectController extends Controller
{
    // listar projetos
    public function index(){
        return view('Backend.Projetos.index');
    }
    
    // listar projetos
    public function get(){
        $projects = Project::all()->toArray();
        return array_reverse($projects);
    }

    // add projeto
    public function add(Request $request)
    {
        $project = new Project([
            'name'      => $request->input('name'),
            'logo'      => $request->input('logo'),
            'author_id' => Auth::user()->id,
            'status'    => $request->input('status')
        ]);
        $project->save();
 
        return response()->json('O projeto foi adicionado com sucesso!');
    }

    // edit projeto
    public function edit($id)
    {
        $project = Project::find($id);
        return response()->json($project);
    }

    // atualizar projeto
    public function update($id, Request $request)
    {
        $project = Project::find($id);
        $project->update($request->all());
 
        return response()->json('O projeto foi atualizado com sucesso!');
    }
 
    // excluir projeto
    public function delete($id)
    {
        $project = Project::find($id);
        $project->delete();
 
        return response()->json('O projeto foi excluido com sucesso!');
    }
}
