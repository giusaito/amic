<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\SiteUtil;
use App\Http\Models\CategorySiteUtil;
use Illuminate\Support\Facades\Storage;
use Image;
use DateTime;

class SiteUtilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteUtils = SiteUtil::with('user')->orderBy('id', 'desc')->paginate(10);

        return view('Backend.SiteUtil.index', compact('siteUtils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategorySiteUtil::orderBy('title', 'asc')->get();
        return view('Backend.SiteUtil.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siteUtil = new SiteUtil;
        $siteUtil->title = $request->title;
        $siteUtil->slug = \Str::slug($request->name);
        $siteUtil->description = $request->description;
        $siteUtil->url = $request->url;
        $siteUtil->author_id = \Auth::id();

        $siteUtil->save();

        $notification = [
            'message' => 'O site ' . $siteUtil->title . ' foi adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.site-util.index')->with($notification);
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
        $siteUtil = SiteUtil::find($id);
        $categories = CategorySiteUtil::orderBy('title', 'asc')->get();
        return view('Backend.SiteUtil.edit', compact('siteUtil', 'categories'));
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

        $siteUtil = SiteUtil::find($id);
        $siteUtil = new SiteUtil;
        $siteUtil->title = $request->title;
        $siteUtil->slug = \Str::slug($request->name);
        $siteUtil->description = $request->description;
        $siteUtil->url = $request->url;
        $siteUtil->author_id = \Auth::id();

        $siteUtil->update();
        
        $notification = [
            'message' => 'O Site ' . $siteUtil->title . ' foi atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.site-util.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteUtil $siteUtil)
    {
        $siteUtil->delete();

        $notification = [
            'message' => 'Site deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.site-util.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $siteUtils = SiteUtil::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.SiteUtil.search', compact('siteUtils'));

    }
}
