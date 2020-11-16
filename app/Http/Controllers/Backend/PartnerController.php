<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Partner;


class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $partner = new Partner();
        $partner->title = $request->title;
        $partner->slug = \Str::slug($request->title);
        $partner->description = $request->description;
        $partner->link = $request->link;
        $partner->type = $request->type;

        $partner->save();

        $notification = [
            'message' =>  $partner->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.patrocinador.index')->with($notification);
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
        $partner = Partner::find($id);
        return view('Backend.Partner.edit', compact('partner'));
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
        $partner = Partner::find($id);
        $partner->title = $request->title;
        $partner->slug = \Str::slug($request->title);
        $partner->description = $request->description;
        $partner->link = $request->link;
        $partner->type = $request->type;

        $partner->update();

        $notification = [
            'message' =>  $partner->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.patrocinador.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $parceiro)
    {
        $parceiro->delete();
        $notification = [
            'message' => 'Patrocinador deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.patrocinador.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $partners = Partner::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Partner.search', compact('partners'));

    }
}
