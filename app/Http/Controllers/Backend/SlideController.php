<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Slide;


class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Slide::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Slide.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record =   new Slide();
        $record->title = $request->title;
        $record->description = $request->description;
        $record->btn_txt = $request->btn_txt;
        $record->url = $request->url;
        $record->photo = $request->photo;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.slide.index')->with($notification);
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
        $record = Slide::find($id);
        return view('Backend.Slide.edit', compact('record'));
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
        $record =   Slide::find($id);
        $record->title = $request->title;
        $record->description = $request->description;
        $record->btn_txt = $request->btn_txt;
        $record->url = $request->url;
        $record->photo = $request->photo;

        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.slide.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slide::find($id)->delete();
        $notification = [
            'message' => 'Slide deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.slide.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $records = Slide::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Slide.search', compact('records'));
    }
}
