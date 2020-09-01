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
    public function get($busca = false){
        if($busca){
            $projects = Project::with(['user','edicoes'])->where(function($query) use($busca){
                $searchWildcard = '%' . $busca . '%';
                $query->orWhere('name', 'LIKE', $searchWildcard);
            })->orderBy('created_at', 'desc')->paginate(20);
        }else {
            $projects = Project::with(['user','edicoes'])->orderBy('created_at', 'desc')->paginate(20);
        }
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'logo' => 'nullable|sometimes|mimes:jpeg,png,jpg'
        ],
        [
            'name.required' => 'O campo nome do Projeto é obrigatório',
            'name.min' => 'O campo nome do Projeto deve ter no mínimo 3 caracteres',
            'logo.mimes' => 'A logomarca deve ter o formato JPG ou PNG'
        ]);

        $project = new Project();
        $project->name = $request->name;

        $path = $request->file('logo')->store('projects/logo');

        $project->logo = $path;

        if ($project->save()) {
            return response()->json($project, 200);
        } else {
            return response()->json([
                'message' => 'Ocorreu algum erro durante o processo! Por favor, tente novamente.',
                'status_code' => 500
            ], 500);
        }
    }

    // add projeto
    // public function add(Request $request)
    // {
    //     $project = new Project([
    //         'name'      => $request->input('name'),
    //         'logo'      => $request->input('logo'),
    //         'author_id' => Auth::user()->id,
    //         'status'    => $request->input('status')
    //     ]);
    //     $project->save();
 
    //     return response()->json('O projeto foi adicionado com sucesso!');
    // }

    // // edit projeto
    // public function edit($id)
    // {
    //     $project = Project::find($id);
    //     return response()->json($project);
    // }

    // // atualizar projeto
    // public function update($id, Request $request)
    // {
    //     $project = Project::find($id);
    //     $project->update($request->all());
 
    //     return response()->json('O projeto foi atualizado com sucesso!');
    // }
 
    // // excluir projeto
    // public function delete($id)
    // {
    //     $project = Project::find($id);
    //     $project->delete();
 
    //     return response()->json('O projeto foi excluido com sucesso!');
    // }
}
