<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Str;
use Response;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query('keyword');

        if($query) {
            $links = link::search($query)->paginate(10);
            $response = [
                'pagination' => [
                    'total' => $links->total(),
                    'per_page' => $links->perPage(),
                    'current_page' => $links->currentPage(),
                    'last_page' => $links->lastPage(),
                    'from' => $links->firstItem(),
                    'to' => $links->lastItem()
                ],
                'data' => $links
            ];
            return response()->json($response);
        } else {
            $links = link::orderBy('id', 'DESC')->paginate(10);
            $response = [
                'pagination' => [
                    'total' => $links->total(),
                    'per_page' => $links->perPage(),
                    'current_page' => $links->currentPage(),
                    'last_page' => $links->lastPage(),
                    'from' => $links->firstItem(),
                    'to' => $links->lastItem()
                ],
                'data' => $links
            ];
            return response()->json($response);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
       $link = Link::firstOrCreate([
           'name' => $request->name,
           'description' => $request->description,
           'slug' => Str::slug($request->name),
           'url' => $request->url
       ]);

       $link->categorysLinks()->attach($request->category); //list of category id's

       return Response::json(array('success' => true, 'last_insert_id' => $request->id), 200);
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
        //
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
        $link = Link::findOrFail($request->id);
        $link->name = $request->name;
        $link->description = $request->description;
        $link->slug = Str::slug($request->name);
        $link->url = $request->url;
        $link->update();

        return Response::json(array('success' => true, 'last_insert_id' => $request->id), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $link = Link::findOrFail($id)->delete();
        return Response::json(array('success' => true, 'message' => 'deletado com sucesso'), 200);
    }
}
