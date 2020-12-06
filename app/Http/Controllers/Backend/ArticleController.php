<?php
/*
 * Projeto: amic
 * Arquivo: ArticleController.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 9:59:44 am
 * Last Modified:  30/11/2020 4:32:31 pm
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
use App\Http\Models\Article;
use App\Http\Models\CategoryArticle;
use App\Http\Models\Tag;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class ArticleController extends Controller
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
        $articles = Article::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editorias = CategoryArticle::all();
        return view('Backend.Article.create', compact('editorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();
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

            $thumb1   = Image::make($file)->fit(150, 200)->encode($ext, 70);

            $thumb2   = Image::make($file)->fit(1200, 380)->encode($ext, 70);

            $thumb3   = Image::make($file)->fit(500, 300)->encode($ext, 70);

            $path = "noticia/" . date('Y/m/d/');

            $this->storage->put($path. 'original-' . $file->hashName(),  $original);

            $this->storage->put($path. '150x200-'.  $file->hashName(),  $thumb1);

            $this->storage->put($path. '1200x380-'.  $file->hashName(),  $thumb2);

            $this->storage->put($path. '500x300-'.  $file->hashName(),  $thumb3);

           $hashname = $file->hashName();
        }

        $article->title = $request->title;
        $article->slug = \Str::slug($request->title);
        $article->description = $request->description;
        $article->video = $request->video;
        $article->alternative_link = $request->alternative_link;
        $article->content = $request->content;
        $article->template_id = $request->template_id;
        $article->path = isset($path) ? $path : NULL;
        $article->image = isset($hashname) ? $hashname : NULL;
        $article->published_at = $agendamento;
        $article->author_photo = $request->author_photo;
        $article->status = $request->status;
        $article->feature = (int) $request->feature;
        $article->font = $request->font;
        $article->author_id = \Auth::id();

        $article->save();

        $article->editorias()->attach($request->editoria);

        if(!empty($request->tags)){
            foreach($request->tags as $tag){
                $tags = Tag::firstOrCreate([
                    'title' => mb_strtolower($tag, 'UTF-8'),
                    'slug' => str_slug($tag)
                ]);

                $article->tag()->attach($tags->id);
            }
        } 

        $notification = [
            'message' => 'A notícia ' . $article->title . ' foi adicionada com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.noticia.index')->with($notification);
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
        $article = Article::find($id);
        $editorias = CategoryArticle::all();

        $editoriasSalvas = [];
        foreach($article->editorias as $editoria){
            $editoriasSalvas[] = $editoria->id;
        }
        
        return view('Backend.Article.edit', compact('article', 'editorias', 'editoriasSalvas'));
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
        $agendamento = Carbon::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');

        $article = Article::find($id);

        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 200)->encode($ext, 70);

            $thumb2   = Image::make($file)->fit(1200, 380)->encode($ext, 70);

            $thumb3   = Image::make($file)->fit(500, 300)->encode($ext, 70);

            $path = "noticia/" . date('Y/m/d/');

            $this->storage->put($path. 'original-' . $file->hashName(),  $original);

            $this->storage->put($path. '150x200-'.  $file->hashName(),  $thumb1);

            $this->storage->put($path. '1200x380-'.  $file->hashName(),  $thumb2);

            $this->storage->put($path. '500x300-'.  $file->hashName(),  $thumb3);

           $hashname = $file->hashName();
        }
        
        $isPhoto = (int)$request->isPhoto;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto == 1) {
            $path = $article->path;
            $hashname = $article->image;
            
        }else if($isPhoto == 2){
            $path = NULL;
            $hashname = NULL;
        }
        else if($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }

        $article->title = $request->title;
        $article->slug = \Str::slug($request->title);
        $article->description = $request->description;
        $article->video = $request->video;
        $article->alternative_link = $request->alternative_link;
        $article->content = $request->content;
        $article->path = isset($path) ? $path : NULL;
        $article->image = isset($hashname) ? $hashname : NULL;
        $article->author_photo = $request->author_photo;
        $article->template_id = $request->template_id;
        $article->published_at = $agendamento;
        $article->status = $request->status;
        $article->feature = (int) $request->feature;
        $article->font = $request->font;
        $article->author_edit_id = \Auth::id();

        $article->update();

        $article->editorias()->sync($request->editoria);
        

        $article->tag()->detach();
        
        if(!empty($request->tags)){
           foreach($request->tags as $tag){
                $tags = Tag::firstOrCreate([
                    'title' => mb_strtolower($tag, 'UTF-8'),
                    'slug' => str_slug($tag)
                ]);

                $article->tag()->attach($tags->id);
            }
        }

        $notification = [
            'message' => 'A notícia ' . $article->title . ' foi atualizada com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.noticia.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $noticium)
    {
        $this->storage->delete($noticium->path . 'original-' . $noticium->image);
        $this->storage->delete($noticium->path . '1500x200-' . $noticium->image);
        $this->storage->delete($noticium->path . '1200x380-' . $noticium->image);
        $this->storage->delete($noticium->path . '500x300-' . $noticium->image);
        $noticium->delete();

        $notification = [
            'message' => 'Artigo deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.noticia.index')->with($notification);
    }

    public function search(Request $request){
        $search = false;
    	if ($request->has('pesquisar')) {
    		$search = true;
            $q = $request->input('pesquisar');
            $articles = Article::search($q)->orderBy('id','desc')->paginate(10);
        }else {
        	$articles = Article::orderBy('id','desc')->with('user')->paginate(10);
        }
    	return view('Backend.Article.search', compact('articles','search'));
    }

    public function tag(Request $request){
        $query = $request->input('query');

    	$pesquisaTag = Tag::where('title','like','%'.$query.'%')->get(['tags.id','tags.title AS text']);

		return response()->json($pesquisaTag);
    }

    public function push($id){
        $APP_ID = 'a5b4524b-7831-4a5a-a268-ced5d946ee4d';
        $SECRET_KEY = 'ZjIyODUzMzMtOWE3YS00NjQxLWE0NmUtOGQyMmI0MmY4MzNk';

        $noticia = Article::where('id',$id)->with(['editorias'])->first();
    
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        if(!empty($noticia->path) && !empty($noticia->photo)){
            $imagem =  env('APP_URL') . "/storage/" . $noticia->path . 'original/' . $noticia->image;
        }else {
            $imagem = '';
        }
        if(isset($noticia->editorias[0]['name'])){
            $editoria = $noticia->editorias[0]['name'];
        }else {
            $editoria = '';
        }


        $date = Carbon::createFromTimeStamp(strtotime($noticia->created_at));
        $date_only = $date->formatLocalized('%A %d de %B de %Y às %H:%M:%S');
      
        $fields = array(
            'app_id' => $APP_ID,
            'included_segments' => array('All'),
            'data' => array(
                'noticiaId' => $noticia->id,
                'editoria' => $editoria,
                'cabecalho' => utf8_encode($date_only),
                'titulo' => $noticia->title,
                'gravata' => $noticia->gravata,
                'icon' => $imagem,
                'link' => '/noticia/'.$noticia->id.'/'.$noticia->slug,
            ),
            'url' => env('APP_URL') . "/noticia/".$noticia->id.'/'.$noticia->slug,
            'headings' => array(
                'en' => $editoria,
                'icon' =>  $imagem,
                'image' => $imagem,

            ),
            'contents' => array(
                'en' => $noticia->title,
                'icon' =>  $imagem,
                'image' => $imagem,
            ),

        );


        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic '.$SECRET_KEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);


        $notification = array(
            'message' => 'Push '.$noticia->title.' enviado com sucesso!',
            'alert-type' => 'success'
        );
        return redirect()->route('backend.noticia.index')->with($notification);
    }
}