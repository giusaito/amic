<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'logo' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,webp'
        ],
        [
            'name.required' => 'O campo nome do Projeto é obrigatório',
            'name.min' => 'O campo nome do Projeto deve ter no mínimo 3 caracteres',
            'logo.image' => 'A logomarca não é uma imagem',
            'logo.mimes' => 'A logomarca deve ter o formato JPG ou PNG'
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->author_id = $request->author_id;
        
        $logo = $request->file('logo');
        if($logo){
            $logoNome = time().uniqid(rand());
            $logoExtensao = $logo->guessExtension();

            $project->logo = $logoNome.".".$logoExtensao;
            $path = $logo->storeAs('public/images/projects/logo', $logoNome.'.'.$logoExtensao,'local');
        }

        if ($project->save()) {
            return response()->json($project, 200);
        } else {
            return response()->json([
                'message' => 'Ocorreu algum erro durante o processo! Por favor, tente novamente.',
                'status_code' => 500
            ], 500);
        }
    }
    public function update(Request $request, Project $projeto){
        $request->validate([
            'name' => 'required|min:3',
            'logo' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,webp'
        ],
        [
            'name.required' => 'O campo nome do Projeto é obrigatório',
            'name.min' => 'O campo nome do Projeto deve ter no mínimo 3 caracteres',
            'logo.image' => 'A logomarca não é uma imagem',
            'logo.mimes' => 'A logomarca deve ter o formato JPG ou PNG'
        ]);

        $projeto->name = $request->name;
        $oldPath = $projeto->logo;
        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $logoNome = time().uniqid(rand());
            $logoExtensao = $logo->guessExtension();

            $projeto->logo = $logoNome.".".$logoExtensao;
            $path = $logo->storeAs('public/images/projects/logo', $logoNome.'.'.$logoExtensao,'local');

            Storage::delete($oldPath);
        }

        if($projeto->save()){
            return response()->json($projeto, 200);
        }else {
            Storage::delete($path);
            return response()->json([
                'message' => 'Ocorreu algum erro durante o processo! Por favor, tente novamente.',
                'status_code' => 500
            ], 500);
        }
    }
    public function destroy(Project $projeto){
        if($projeto->delete()) {
            Storage::delete('public/images/projects/logo/'.$projeto->logo);
            return response()->json([
                'message' => 'O projeto '.$projeto->name.' foi excluído com sucesso',
                'status_code' => 200
            ], 200);
        }else {
            return response()->json([
                'message' => 'Houve um problema para excluir o projeto '.$projeto->name.'. Por favor tente novamente.',
                'status_code' => 500
            ], 500);
        }
    }
}
