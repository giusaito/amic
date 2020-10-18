<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Podcast;
use Image;
use DateTime;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
        $file = $request->file('thumbnail');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "podcast/";

            $this->storage->put($path. 'original/' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150/-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }

        $podcast = new Podcast();
        if(!empty($request->published_at)){
            $agendamento = DateTime::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');
        }else {
            $agendamento = date('Y-m-d H:i:s');
        }

        $podcast->title = $request->title;
        $podcast->slug = \Str::slug($request->name);
        $podcast->description = $request->description;
        $podcast->image = $request->image;
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
        if(!empty($request->published_at)){
            $agendamento = DateTime::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');
        }else {
            $agendamento = date('Y-m-d H:i:s');
        }


        $podcast = Podcast::find($id);
        $podcast->title = $request->title;
        $podcast->slug = \Str::slug($request->name);
        $podcast->description = $request->description;
        $podcast->image = $request->image;
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
    public function destroy($id)
    {
        $podcast->delete();
        Storage::delete('public/images/tvamic/'.$podcast->image);

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