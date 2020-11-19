<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Team;
use Illuminate\Support\Facades\Storage;
use Image;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $image_ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'];

    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }

    public function index()
    {
        $records = Team::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Team.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "team/" . date('Y/m/d/');

            $this->storage->put($path. 'original-' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }
        
        $record =  new Team();
        $record->name = $request->name;
        $record->description = $request->description;
        $record->office = $request->office;
        $record->whatsapp = $request->whatsapp;
        $record->email = $request->email;
        $record->path = isset($path) ? $path : NULL;
        $record->image = isset($hashname) ? $hashname : NULL;
        $record->director = $request->director;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.equipe.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Team::find($id);
        return view('Backend.Team.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = Team::find($id);

        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "team/" . date('Y/m/d/');

            $this->storage->put($path. 'original-' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }
        

        $isPhoto = (int)$request->isPhoto;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto == 1) {
            $path = $record->path;
            $hashname = $record->image;
            
        }else if($isPhoto == 2){
            $path = NULL;
            $hashname = NULL;
        }
        else if($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }

        $record->name = $request->name;
        $record->description = $request->description;
        $record->office = $request->office;
        $record->whatsapp = $request->whatsapp;
        $record->email = $request->email;
        $record->path = isset($path) ? $path : NULL;
        $record->image = isset($hashname) ? $hashname : NULL;
        $record->director = $request->director;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.equipe.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $equipe)
    {
        $this->storage->delete($equipe->path . 'original-' . $equipe->image);
        $this->storage->delete($equipe->path . '150x150-' . $equipe->image);
        $equipe->delete();

        $notification = [
            'message' => 'Colaborador deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.equipe.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $records = Team::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('name', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Team.search', compact('records'));
    }
}
