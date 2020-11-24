<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Image;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $image_ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'];

    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }

    public function index()
    {
        $record = Setting::first();
        return view('Backend.Setting.index', compact('record'));
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
        //
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
        $record = Setting::find($id);
        return view('Backend.Setting.edit', compact('record'));
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
        $record = Setting::find($id);

        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();
            $height = Image::make($file)->height();
            $width = Image::make($file)->width();
            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);
            $path = "configuracao/" . date('Y/m/d/');
            $this->storage->put($path. $file->hashName(),  $original);
           $hashname = $file->hashName();
        }

        $isPhoto = (int)$request->isPhoto;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto == 1) {
            $logoPrincipal = $record->logomarca;
            
        }else if($isPhoto == 2 || $isPhoto == 0){
            return back()->with('error','Não é permitido deixar o campo de logo sem arquivo. Por favor, faça o upload de uma logo');
        }
        else if($isPhoto == 3){
            $logoPrincipal = $path . $hashname;
        }
        
        $file_footer = $request->file('feature_image_footer');
        if($file_footer){
            $ext = $file_footer->getClientOriginalExtension();
            $height = Image::make($file_footer)->height();
            $width = Image::make($file_footer)->width();
            $original = Image::make($file_footer)->fit($width, $height)->encode($ext, 70);
            $path = "configuracao/" . date('Y/m/d/');
            $this->storage->put($path . $file_footer->hashName(),  $original);
           $hashnameFooter = $file_footer->hashName();
        }

        
        $isPhotoFooter = (int)$request->isPhotoFooter;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhotoFooter == 1) {
            $logoFooter = $record->logomarca_footer;
            
        }else if($isPhotoFooter == 2){
            return back()->with('error','Não é permitido deixar o campo de logo sem arquivo. Por favor, faça o upload de uma logo');
        }
        else if($isPhotoFooter == 3){
            $logoFooter = $path . $hashnameFooter;
        }
        
        $record->name = $request->name;
        $record->email = $request->email;
        $record->address = $request->address;
        $record->address_number = $request->address_number;
        $record->zipcode = $request->zipcode;
        $record->city = $request->city;
        $record->state = $request->state;
        $record->phone = $request->phone;
        $record->phone2 = $request->phone2;
        $record->whatsapp = $request->whatsapp;
        $record->whatsapp2 = $request->whatsapp2;
        $record->facebook = $request->facebook;
        $record->instagram = $request->instagram;
        $record->twitter = $request->twitter;
        $record->linkedin = $request->linkedin;
        $record->youtube = $request->youtube;
        $record->logomarca = $logoPrincipal;
        $record->logomarca_footer = $logoFooter;

        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.configuracoes.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
