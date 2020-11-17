<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Ads;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Ads::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Ads.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record =   new Ads();
        $record->title = $request->title;
        $record->code = $request->code;
        $record->position = $request->position;
        $record->page = $request->page;
        $record->created = Auth::user()->name;

        $record->save();

        $notification = [
            'message' =>  $record->name . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.publicidade.index')->with($notification);
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
        $record = Ads::find($id);
        return view('Backend.Ads.edit', compact('record'));
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
        $record =   Ads::find($id);
        $record->title = $request->title;
        $record->code = $request->code;
        $record->position = $request->position;
        $record->page = $request->page;
        $record->last_updated = Auth::user()->name;

        $record->update();

        $notification = [
            'message' =>  $record->name . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.publicidade.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ads::find($id)->delete();
        $notification = [
            'message' => 'Publicidade deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.publicidade.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');
        $records = Ads::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Ads.search', compact('records'));
    }
}
