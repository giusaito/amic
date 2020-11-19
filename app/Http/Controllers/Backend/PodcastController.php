<?php
/*
 * Projeto: amic
 * Arquivo: PodcastController.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 9:29:59 am
 * Last Modified:  19/11/2020 10:41:11 am
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Podcast;
use Illuminate\Support\Facades\Storage;
use Image;
use DateTime;

class PodcastController extends Controller
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
        $podcasts = Podcast::with('user')->orderBy('id', 'desc')->paginate(10);

        return view('Backend.Podcast.index', compact('podcasts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Podcast.create');
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

            $path = "podcast/" . date('Y/m/d/');

            $this->storage->put($path. 'original-' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }

        $podcast = new Podcast();
        if(!empty($request->published_at)){
            $agendamento = DateTime::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');
        }else {
            $agendamento = date('Y-m-d H:i:s');
        }

        $podcast->title = $request->title;
        $podcast->slug = \Str::slug($request->title);
        $podcast->description = $request->description;
        $podcast->path = isset($path) ? $path : NULL;
        $podcast->image = isset($hashname) ? $hashname : NULL;
        $podcast->iframe = $request->iframe;
        $podcast->content = $request->content;
        $podcast->published_at = $agendamento;
        $podcast->status = $request->status;
        $podcast->author_id = \Auth::id();

        $podcast->save();

        $notification = [
            'message' => 'O Podcast ' . $podcast->title . ' foi adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.podcast.index')->with($notification);
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
        $podcast = Podcast::find($id);
        return view('Backend.Podcast.edit', compact('podcast'));
    }

    /**
     * update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $podcast = Podcast::find($id);

        if(!empty($request->published_at)){
            $agendamento = DateTime::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');
        }else {
            $agendamento = date('Y-m-d H:i:s');
        }

        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "podcast/" . date('Y/m/d/');

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
            $path = $podcast->path;
            $hashname = $podcast->image;
            
        }else if($isPhoto == 2){
            $path = NULL;
            $hashname = NULL;
        }
        else if($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }

        $podcast->title = $request->title;
        $podcast->slug = \Str::slug($request->title);
        $podcast->description = $request->description;
        $podcast->path = isset($path) ? $path : NULL;
        $podcast->image = isset($hashname) ? $hashname : NULL;
        $podcast->iframe = $request->iframe;
        $podcast->content = $request->content;
        $podcast->published_at = $agendamento;
        $podcast->status = $request->status;
        
        $podcast->update();
        
        $notification = [
            'message' => 'O podcast ' . $podcast->title . ' foi atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.podcast.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Podcast $podcast)
    {
        $this->storage->delete($podcast->path . 'original-' . $podcast->image);
        $this->storage->delete($podcast->path . '150x150-' . $podcast->image);
        
        $podcast->delete();
        
        $notification = [
            'message' => 'Podcast deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.podcast.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $podcasts = Podcast::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Podcast.search', compact('podcasts'));

    }
}
