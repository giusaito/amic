<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TvAmic;
use Embed\Embed;

class TvAmicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.TvAmic.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function process_video(Request $request){
        $process = Embed::create($request->url_video);
        $response = $process->code;
        return response()->json($response, 200);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tvamic = new TvAmic();
        $tvamic->name = $request->name;
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
        $tvamic->author_id = $request->author_id;

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
        $tvamic = TvAmic::find($id);
        return response()->json($tvamic, 200);
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
        $tvamic = new TvAmic();
        $tvamic->name = $request->name;
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
        $tvamic->author_id = $request->author_id;

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvAmic $TvAmic)
    {
        if($TvAmic->delete()) {
            Storage::delete('public/images/tvamic/'.$TvAmic->image);
            return response()->json([
                'message' => 'O vídeo '.$tvamic->name.' foi excluído com sucesso',
                'status_code' => 200
            ], 200);
        }else {
            return response()->json([
                'message' => 'Houve um problema para excluir o vídeo '.$TvAmic->name.'. Por favor tente novamente.',
                'status_code' => 500
            ], 500);
        }
    }
}
