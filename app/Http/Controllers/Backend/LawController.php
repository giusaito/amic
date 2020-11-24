<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Law;
use Illuminate\Support\Facades\Storage;
use Image;

class LawController extends Controller
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
        $records = Law::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Law.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Law.create');
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

            $path = "lei-regimento/img/" . date('Y/m/d/');

            $this->storage->put($path. 'original-' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }
        
        $file = $request->file('archive');
        if($file){
            $pathArch = "lei-regimento/archive/" . date('Y/m/d/');
            $this->storage->put($pathArch,  $file);
           $hashnameArchive = $file->hashName();
           $url = asset('storage') . '/' . $pathArch . $hashnameArchive;
        }elseif($request->url){
            $url = $request->url;
        }else {
            return back()->with('error','Por favor, faça o upload de um arquivo ou preencha o campo URL');
        }
                
        $record = new Law;
        $record->title = $request->title;
        $record->slug = \Str::slug($request->title);
        $record->description = $request->description;
        $record->archive = isset($hashnameArchive) ? $pathArch . $hashnameArchive : NULL;
        $record->path = isset($path) ? $path : NULL;
        $record->image = isset($hashname) ? $hashname : NULL;
        $record->url = $url;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.lei.index')->with($notification);
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
        $record = Law::find($id);
        return view('Backend.Law.edit', compact('record'));
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
        $file = $request->file('feature_image');

        // if(!empty($request->url)){
        //     return back()->with('error','Por favor, faça o upload de um arquivo ou preencha o campo URL');
        // }

        $record = Law::find($id);

        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "lei-regimento/archive/" . date('Y/m/d/');

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
            
        }elseif($isPhoto == 2){
            $path = NULL;
            $hashname = NULL;
        }
        elseif($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }
        
        $file = $request->file('archive');
        if($file){
            $pathArch = "lei-regimento/archive/" . date('Y/m/d/');
            $this->storage->put($pathArch,  $file);
           $hashnameArchive = $file->hashName();
        }

        $isArchive = (int)$request->isArchive;
        /* 1 O Arquivo não foi alterado
           2 Arquivo deletado
           3 Arquivo alterado
        */

        if($isArchive == 1) {
            $hashnameArchive = $record->archive;
            $pathArch = "lei-regimento/archive/" . date('Y/m/d/');
            $url = $record->url;
        }elseif($isArchive == 2 || $isArchive == 0){
            if(is_null($request->url)){
                return back()->with('error','Por favor, faça o upload de um arquivo ou preencha o campo URL');
            }else {
                $this->storage->delete($record->archive);
                $hashnameArchive = NULL;
                $url = $request->url;
            }
        }
        else if($isArchive == 3){
            $this->storage->delete($record->archive);
            // dd($record->archive);
            $hashnameArchive = $hashnameArchive;
            $url = asset('storage') . '/' . $pathArch . $hashnameArchive;
        }
        
        $record->title = $request->title;
        $record->slug = \Str::slug($request->title);
        $record->description = $request->description;
        $record->archive = isset($hashnameArchive) ? $pathArch . $hashnameArchive : NULL;
        $record->path = isset($path) ? $path : NULL;
        $record->image = isset($hashname) ? $hashname : NULL;
        $record->url = $url;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.lei.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Law $lei_e_regimento)
    {
        $this->storage->delete($lei_e_regimento->path . 'original-' . $lei_e_regimento->image);
        $this->storage->delete($lei_e_regimento->path . '150x150-' . $lei_e_regimento->image);
        $this->storage->delete($lei_e_regimento->archive);
       
        $lei_e_regimento->delete();

        $notification = [
            'message' => 'Lei/Regimento deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.lei.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $records = Law::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Law.search', compact('records'));
    }
}
