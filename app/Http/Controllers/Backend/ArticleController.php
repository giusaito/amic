<?php
/*
 * Projeto: amic
 * Arquivo: ArticleController.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 9:59:44 am
 * Last Modified:  11/11/2020 3:07:52 pm
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
use DateTime;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('Backend.Article.create');
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

        $article->title = $request->title;
        $article->slug = \Str::slug($request->title);
        $article->description = $request->description;
        $article->video = $request->video;
        $article->alternative_link = $request->alternative_link;
        $article->content = $request->content;
        $article->template_id = 3;
        $article->published_at = $agendamento;
        $article->status = $request->status;
        $article->feature = (int) $request->feature;
        $article->font = $request->font;
        $article->author_id = \Auth::id();

        $article->save();

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
        $podcast = Article::find($id);
        return view('Backend.Article.edit', compact('article'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        Storage::delete('public/images/tvamic/'.$article->image);

        $notification = [
            'message' => 'Artigo deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.noticia.index')->with($notification);
    }
}
