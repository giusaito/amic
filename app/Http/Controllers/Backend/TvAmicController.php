<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TvAmic;
use Embed\Embed;
use Illuminate\Support\Facades\Storage;
use Image;
class TvAmicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tvAmic = TvAmic::with('user')->orderBy('id', 'desc')->paginate(20);
        return view('Backend.TvAmic.index', compact('tvAmic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function process_video(Request $request){
        $process = Embed::create($request->url_video);
        $result = [
           "url_video" => $request->url_video,
           "title" => $process->title,
           "description" => $process->description,
           "image" => $process->image,
           "iframe" => $process->code,
           "width" => $process->width,
           "height" => $process->height,
           "provider_name" => $process->providerName,
           "provider_url" => $process->providerUrl,
           "license" => $process->license,
           "status" => $process->status,
           "author_id" => $process->author_id,
        ];
        return response()->json($result, 200);
    }

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
        $tvamic->title = $request->title;
        $tvamic->slug = \Str::slug($request->title);
        $tvamic->url_video = $request->url_video;
        $tvamic->description = $request->description;
        // $tvamic->image = $hashname;
        $tvamic->iframe = $request->iframe;
        $tvamic->width = $request->width;
        $tvamic->height = $request->height;
        $tvamic->provider_name = $request->provider_name;
        $tvamic->provider_url = $request->provider_url;
        $tvamic->license = $request->license;
        $tvamic->status = $request->status;
        $tvamic->author_id = Auth::id();

        if ($tvamic->save()) {
            return response()->json($tvamic, 200);
        } else {
            return response()->json([
                'message' => 'Ocorreu algum erro durante o processo! Por favor, tente novamente.',
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tvamic = TvAmic::with(['user'])->orderBy('created_at', 'desc')->paginate(20);
        return response()->json($tvamic, 200);
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
        $tvamic = TvAmic::find($id);
        $tvamic->title = $request->title;
        $tvamic->slug = \Str::slug($request->name);
        $tvamic->url_video = $request->url_video;
        $tvamic->description = $request->description;
        $tvamic->image = $request->image;
        $tvamic->iframe = $request->iframe;
        $tvamic->width = $request->width;
        $tvamic->height = $request->height;
        $tvamic->provider_name = $request->provider_name;
        $tvamic->provider_url = $request->provider_url;
        $tvamic->license = $request->license;
        $tvamic->status = $request->status;

        if ($tvamic->update()) {
            return 'salvo';
        } else {
            return response()->json([
                'message' => 'Ocorreu algum erro durante o processo! Por favor, tente novamente.',
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvAmic $tvAmic)
    {
        if($tvAmic->delete()) {
            Storage::delete('public/images/tvamic/'.$tvAmic->image);
            return response()->json([
                'message' => 'O vídeo '.$tvAmic->title.' foi excluído com sucesso',
                'status_code' => 200
            ], 200);
        }else {
            return response()->json([
                'message' => 'Houve um problema para excluir o vídeo '.$tvAmic->title.'. Por favor tente novamente.',
                'status_code' => 500
            ], 500);
        }
    }

     public function search($search = false){
        $tvAmic = TvAmic::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('created_at', 'desc')->paginate(20);
        return response()->json($tvAmic, 200);
    }
}
