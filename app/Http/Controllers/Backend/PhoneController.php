<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Phone;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Phone::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Phone.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Phone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record =   new Phone();
        $record->name = $request->name;
        $record->phone = $request->phone;
        $record->url = $request->url;

        $record->save();

        $notification = [
            'message' =>  $record->name . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.telefone.index')->with($notification);
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
        $record = Phone::find($id);
        return view('Backend.Phone.edit', compact('record'));
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
        $record =   Phone::find($id);
        $record->name = $request->name;
        $record->phone = $request->phone;
        $record->url = $request->url;

        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.telefone.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Phone::find($id)->delete();
        $notification = [
            'message' => 'Telefone deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.telefone.index')->with($notification);
    }
    public function search(Request $request){
        $search = $request->input('pesquisar');

        $records = Phone::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('name', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Phone.search', compact('records'));
    }
}
