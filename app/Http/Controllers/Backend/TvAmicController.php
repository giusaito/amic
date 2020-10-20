<?php
/*
 * Projeto: amic
 * Arquivo: TvAmicController.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: oi@bewweb.com.br
 * ---------------------------------------------------------------------
 * Data da criação: 19/10/2020 9:02:37 pm
 * Last Modified:  19/10/2020 11:54:40 pm
 * Modificado por: Leonardo Nascimento - <oi@bewweb.com.br>
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Bewweb
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

namespace App\Http\Controllers\Backend; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TvAmic;
use Embed\Embed;
use Illuminate\Support\Facades\Storage;
use Image;
use DateTime;

class TvAmicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tvAmic = TvAmic::with('user')->orderBy('id', 'desc')->paginate(10);

        return view('Backend.TvAmic.index', compact('tvAmic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('Backend.TvAmic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $file = $request->file('logo');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "tv-amic/";

            $this->storage->put($path. 'original/' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150/-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }

        $tvamic = new TvAmic();
        if(!empty($request->published_at)){
            $agendamento = DateTime::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');
        }else {
            $agendamento = date('Y-m-d H:i:s');
        }

        $tvamic->title = $request->title;
        $tvamic->slug = \Str::slug($request->name);
        $tvamic->description = $request->description;
        $tvamic->image = $request->image;
        $tvamic->iframe = $request->iframe;
        $tvamic->content = $request->content;
        $tvamic->published_at = $agendamento;
        $tvamic->status = $request->status;
        $tvamic->author_id = \Auth::id();

        $tvamic->save();

        $notification = [
            'message' => 'O vídeo ' . $tvamic->title . ' foi adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.tv-amic.index')->with($notification);
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
        $tv = TvAmic::find($id);
        return view('Backend.TvAmic.edit', compact('tv'));

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
        dd($request->all());

        if(!empty($request->published_at)){
            $agendamento = DateTime::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');
        }else {
            $agendamento = date('Y-m-d H:i:s');
        }


        $tvamic = TvAmic::find($id);
        $tvamic->title = $request->title;
        $tvamic->slug = \Str::slug($request->name);
        $tvamic->description = $request->description;
        $tvamic->image = $request->image;
        $tvamic->iframe = $request->iframe;
        $tvamic->content = $request->content;
        $tvamic->published_at = $agendamento;
        $tvamic->status = $request->status;

        $tvamic->update();
        
        $notification = [
            'message' => 'O vídeo ' . $tvamic->title . ' foi atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.tv-amic.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvAmic $tvAmic)
    {
       $tvAmic->delete();
       Storage::delete('public/images/tvamic/'.$tvAmic->image);

        $notification = [
            'message' => 'Vídeo deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.tv-amic.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $tvAmic = TvAmic::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.TvAmic.search', compact('tvAmic'));

    }
    
}
