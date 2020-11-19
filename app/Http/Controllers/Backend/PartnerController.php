<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Image;

class PartnerController extends Controller
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
        $partners = Partner::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Partner.create');
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

            $path = "partner/" . date('Y/m/d/');

            $this->storage->put($path. 'original-' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }

        $partner = new Partner();
        $partner->title = $request->title;
        $partner->slug = \Str::slug($request->title);
        $partner->description = $request->description;
        $partner->link = $request->link;
        $partner->path = isset($path) ? $path : NULL;
        $partner->image = isset($hashname) ? $hashname : NULL;
        $partner->type = $request->type;

        $partner->save();

        $notification = [
            'message' =>  $partner->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.patrocinador.index')->with($notification);
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
        $partner = Partner::find($id);
        return view('Backend.Partner.edit', compact('partner'));
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
        $partner = Partner::find($id);

        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "partner/" . date('Y/m/d/');

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
            $path = $partner->path;
            $hashname = $partner->image;
            
        }else if($isPhoto == 2){
            $path = NULL;
            $hashname = NULL;
        }
        else if($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }

        $partner->title = $request->title;
        $partner->slug = \Str::slug($request->title);
        $partner->description = $request->description;
        $partner->path = isset($path) ? $path : NULL;
        $partner->image = isset($hashname) ? $hashname : NULL;
        $partner->link = $request->link;
        $partner->type = $request->type;

        $partner->update();

        $notification = [
            'message' =>  $partner->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.patrocinador.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $patrocinador)
    {
        $this->storage->delete($patrocinador->path . 'original-' . $patrocinador->image);
        $this->storage->delete($patrocinador->path . '150x150-' . $patrocinador->image);
        $patrocinador->delete();

        $notification = [
            'message' => 'Patrocinador deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.patrocinador.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $partners = Partner::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Partner.search', compact('partners'));

    }
}
