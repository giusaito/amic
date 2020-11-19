<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Informative;
use Illuminate\Support\Facades\Storage;
use Image;


class InformativeController extends Controller
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
        $records = Informative::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Informative.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Informative.create');
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

            $path = "informative/img/" . date('Y/m/d/');

            $this->storage->put($path. 'original-' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }
        
        $file = $request->file('archive');
        if($file){
            $pathArch = "informative/archive/" . date('Y/m/d/');
            $this->storage->put($pathArch,  $file);
           $hashnameArchive = $file->hashName();
        }
        
        
        $record = new Informative;
        $record->title = $request->title;
        $record->slug = \Str::slug($request->title);
        $record->description = $request->description;
        $record->archive = isset($hashnameArchive) ? $pathArch . $hashnameArchive : NULL;
        $record->path = isset($path) ? $path : NULL;
        $record->image = isset($hashname) ? $hashname : NULL;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.informativo.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Informative::find($id);
        return view('Backend.Informative.edit', compact('record'));
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
        $record = Informative::find($id);

        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "informative/img/" . date('Y/m/d/');

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
        
        $file = $request->file('archive');
        if($file){
            $pathArch = "informative/archive/" . date('Y/m/d/');
            $this->storage->put($pathArch,  $file);
           $hashnameArchive = $file->hashName();
        }

        $isArchive = (int)$request->isArchive;
        /* 1 O Arquivo não foi alterado
           2 Arquivo deletado
           3 Arquivo alterado
        */
        if($isArchive == 1) {
            $hashnameArchive = $record->hashnameArchive;            
        }else if($isArchive == 2){
            $hashnameArchive = NULL;
        }
        else if($isArchive == 3){
            $hashnameArchive = $hashnameArchive;
        }

        $record->title = $request->title;
        $record->slug = \Str::slug($request->title);
        $record->description = $request->description;
        $record->archive = isset($hashnameArchive) ? $pathArch . $hashnameArchive : NULL;
        $record->path = isset($path) ? $path : NULL;
        $record->image = isset($hashname) ? $hashname : NULL;

        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.informativo.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informative $informativo)
    {
        $this->storage->delete($informativo->path . 'original-' . $informativo->image);
        $this->storage->delete($informativo->path . '150x150-' . $informativo->image);
        $this->storage->delete($informativo->archive);
       
        $informativo->delete();

        $notification = [
            'message' => 'Informativo deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.informativo.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $records = Informative::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Informative.search', compact('records'));
    }
}
