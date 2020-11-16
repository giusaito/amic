<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Informative;

class InformativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Informative::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Informative.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Informative.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record = new Informative;
        $record->title = $request->title;
        $record->slug = \Str::slug($request->title);
        $record->description = $request->description;
        $record->archive = $request->archive;
        $record->link = $request->link;
        $record->capa = $request->capa;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.informativo.index')->with($notification);
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
        $record = Informative::find($id);
        return view('Backend.Informative.edit', compact('record'));
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
        $record = Informative::find($id);
        $record->title = $request->title;
        $record->slug = \Str::slug($request->title);
        $record->description = $request->description;
        $record->archive = $request->archive;
        $record->link = $request->link;
        $record->capa = $request->capa;

        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.informativo.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Informative::find($id)->delete();
        $notification = [
            'message' => 'Informativo deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.informativo.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $records = Informative::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Informative.search', compact('records'));
    }
}
