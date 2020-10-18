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
        $file = $request->file('thumbnail');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);

            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);

            $path = "site-util/";

            $this->storage->put($path. 'original/' . $file->hashName(),  $original);

            $this->storage->put($path. '150x150/-'.  $file->hashName(),  $thumb1);

           $hashname = $file->hashName();
        }

        $siteUtil = new SiteUtil();
        if(!empty($request->published_at)){
            $agendamento = DateTime::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');
        }else {
            $agendamento = date('Y-m-d H:i:s');
        }

        $siteUtil->title = $request->title;
        $siteUtil->slug = \Str::slug($request->name);
        $siteUtil->description = $request->description;
        $siteUtil->image = $request->image;
        $siteUtil->url = $request->url;
        $siteUtil->published_at = $agendamento;
        $siteUtil->status = $request->status;
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
        return view('Backend.SiteUtil.edit', compact('siteUtil'));
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
        if(!empty($request->published_at)){
            $agendamento = DateTime::createFromFormat('d/m/Y H:i', $request->published_at)->format('Y-m-d H:i:s');
        }else {
            $agendamento = date('Y-m-d H:i:s');
        }


        $siteUtil = SiteUtil::find($id);
        $siteUtil->title = $request->title;
        $siteUtil->slug = \Str::slug($request->name);
        $siteUtil->description = $request->description;
        $siteUtil->image = $request->image;
        $siteUtil->url = $request->url;
        $siteUtil->published_at = $agendamento;
        $siteUtil->status = $request->status;

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
        Storage::delete('public/images/tvamic/'.$siteUtil->image);

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
