<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\PhotoArticle;
use App\Http\Models\Article;
use Illuminate\Support\Facades\Storage;
use Image;

class PhotoArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }
    public function index($photo){
        $article = Article::find($photo);
        $records = PhotoArticle::where('article_id', $photo)->exists();
        if($records) {
            $records = PhotoArticle::where('article_id', $photo)->get();
        } else {
            $records = NULL;
        }
        return view('Backend.Article.Photo.index', compact('records', 'article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $photo)
    {
        $file = $request->file('file');
        if($file){
            $ext = $file->getClientOriginalExtension();
            $height = Image::make($file)->height();
            $width = Image::make($file)->width();
            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);
            $path = "noticia/" . date('Y/m/d/') . 'fotos/';
            $this->storage->put($path. 'original-' . $file->hashName(),  $original);
            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);
            $hashname = $file->hashName();
        }
        $record                 = new PhotoArticle;
        $record->path           = $path;
        $record->image          = $hashname;
        $record->article_id     = $photo;
        $record->save();

        return response()->json([
            'initialPreview' => ['/storage/'.$path. 'original-' . $hashname],
            'initialPreviewConfig' => [
                ['key' => $record->id, 'exif' => $this->storage->path($path. 'original-' . $hashname)]
            ]
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $record = PhotoArticle::find($request->key);
        if($record->delete()){
            $this->storage->delete($record->path . 'original-' . $record->image);
            $this->storage->delete($record->path . '150x150-' . $record->image);
            return response()->json(['success'=>'Removido']);
        }else {
            return response()->json(['error'=>'Houve um problema para excluir a imagem! por favor, tente novamente!']);
        }
    }
}
