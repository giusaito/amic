<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Event;
use DateTime;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $event = new Event();
        $event->title = $request->title;
        $event->slug = \Str::slug($request->title);
        $event->description = $request->description;
        $event->city_state = $request->city_state;
        $event->address = $request->address;
        $event->start_date = DateTime::createFromFormat('d/m/Y H:i', $request->start_date)->format('Y-m-d H:i:s');
        $event->finish_date = DateTime::createFromFormat('d/m/Y H:i', $request->finish_date)->format('Y-m-d H:i:s');;

        $event->save();

        $notification = [
            'message' => 'O Evento ' . $event->title . ' foi adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.evento.index')->with($notification);
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
        $event = Event::find($id);
        return view('Backend.Event.edit', compact('event'));
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
        $event = Event::find($id);
        $event->title = $request->title;
        $event->slug = \Str::slug($request->title);
        $event->description = $request->description;
        $event->city_state = $request->city_state;
        $event->address = $request->address;
        $event->start_date = DateTime::createFromFormat('d/m/Y H:i', $request->start_date)->format('Y-m-d H:i:s');
        $event->finish_date = DateTime::createFromFormat('d/m/Y H:i', $request->finish_date)->format('Y-m-d H:i:s');;

        $event->update();

        $notification = [
            'message' => 'O Evento ' . $event->title . ' foi atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.evento.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $evento)
    {
        $evento->delete();
        $notification = [
            'message' => 'Evento deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.evento.index')->with($notification);
    }

    
    public function search(Request $request){
        $search = $request->input('pesquisar');

        $events = Event::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.event.search', compact('events'));

    }
}
