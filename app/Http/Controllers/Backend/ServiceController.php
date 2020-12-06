<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Http\Models\Service;
use Illuminate\Support\Facades\Storage;
use Image;

class ServiceController extends Controller
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
        $records = Service::orderBy('id', 'desc')->paginate(10);
        return view('Backend.Service.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $path = "servicos/" . date('Y/m/d/');
        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();
            $height = Image::make($file)->height();
            $width = Image::make($file)->width();
            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($file)->fit(500, 400)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $file->hashName(),  $original);
            $this->storage->put($path. '500x400-'.  $file->hashName(),  $thumb1);
           $hashname = $file->hashName();
        }
        
        $file_internal = $request->file('image_internal');
        if($file_internal){
            $ext = $file_internal->getClientOriginalExtension();
            $height = Image::make($file_internal)->height();
            $width = Image::make($file_internal)->width();
            $original = Image::make($file_internal)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($file_internal)->fit(150, 150)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $file_internal->hashName(),  $original);
            $this->storage->put($path. '150x150-'.  $file_internal->hashName(),  $thumb1);
           $hashname_internal = $file_internal->hashName();
        }
        
        $benefit_icon_1 = $request->file('benefit_icon_1');
        if($benefit_icon_1){
            $height = Image::make($benefit_icon_1)->height();
            $width = Image::make($benefit_icon_1)->width();
            $original = Image::make($benefit_icon_1)->fit($width, $height)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $benefit_icon_1->hashName(),  $original);
           $benefit_icon_1 = $benefit_icon_1->hashName();
        }
        
        $benefit_icon_2 = $request->file('benefit_icon_2');
        if($benefit_icon_2){
            $height = Image::make($benefit_icon_2)->height();
            $width = Image::make($benefit_icon_2)->width();
            $original = Image::make($benefit_icon_2)->fit($width, $height)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $benefit_icon_2->hashName(),  $original);
           $benefit_icon_2 = $benefit_icon_2->hashName();
        }
        
        $benefit_icon_3 = $request->file('benefit_icon_3');
        if($benefit_icon_3){
            $height = Image::make($benefit_icon_3)->height();
            $width = Image::make($benefit_icon_3)->width();
            $original = Image::make($benefit_icon_3)->fit($width, $height)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $benefit_icon_3->hashName(),  $original);
           $benefit_icon_3 = $benefit_icon_3->hashName();
        }
        
        $benefit_icon_4 = $request->file('benefit_icon_4');
        if($benefit_icon_4){
            $height = Image::make($benefit_icon_4)->height();
            $width = Image::make($benefit_icon_4)->width();
            $original = Image::make($benefit_icon_4)->fit($width, $height)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $benefit_icon_4->hashName(),  $original);
           $benefit_icon_4 = $benefit_icon_4->hashName();
        }

        $record = new Service;
        $record->title = $request->title;
        $record->slug = \Str::slug($request->title);
        $record->description = $request->description;
        $record->content     = $request->content;
        $record->benefit_desc_1 = $request->benefit_desc_1;
        $record->benefit_desc_2 = $request->benefit_desc_2;
        $record->benefit_desc_3 = $request->benefit_desc_3;
        $record->benefit_desc_4 = $request->benefit_desc_4;
        $record->after_content = $request->after_content;
        $record->desc_form_contact = $request->desc_form_contact;
        $record->desc_form_contact = $request->desc_form_contact;
        $record->email_to = $request->email_to;
        $record->path = isset($path) ? $path : NULL;
        $record->image = isset($hashname) ? $hashname : NULL;
        $record->path_internal = isset($path) ? $path : NULL;
        $record->image_internal = isset($hashname_internal) ? $hashname_internal : NULL;
        $record->benefit_icon_1 = $benefit_icon_1;
        $record->benefit_icon_2 = $benefit_icon_2;
        $record->benefit_icon_3 = $benefit_icon_3;
        $record->benefit_icon_4 = $benefit_icon_4;
        
        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.servico.index')->with($notification);
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
        $record = Service::find($id);
        return view('Backend.service.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $record = Service::find($id);
        $path = "servicos/" . date('Y/m/d/');
        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();
            $height = Image::make($file)->height();
            $width = Image::make($file)->width();
            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($file)->fit(500, 400)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $file->hashName(),  $original);
            $this->storage->put($path. '500x400-'.  $file->hashName(),  $thumb1);
           $hashname = $file->hashName();
        }
        
        $file_internal = $request->file('image_internal');
        if($file_internal){
            $ext = $file_internal->getClientOriginalExtension();
            $height = Image::make($file_internal)->height();
            $width = Image::make($file_internal)->width();
            $original = Image::make($file_internal)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($file_internal)->fit(150, 150)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $file_internal->hashName(),  $original);
            $this->storage->put($path. '150x150-'.  $file_internal->hashName(),  $thumb1);
           $hashname_internal = $file_internal->hashName();
        }
        
        $benefit_icon_1 = $request->file('benefit_icon_1');
        if($benefit_icon_1){
            $ext = $benefit_icon_1->getClientOriginalExtension();
            $height = Image::make($benefit_icon_1)->height();
            $width = Image::make($benefit_icon_1)->width();
            $original = Image::make($benefit_icon_1)->fit($width, $height)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $benefit_icon_1->hashName(),  $original);
           $benefit_icon_1 = $benefit_icon_1->hashName();
        }
        
        $benefit_icon_2 = $request->file('benefit_icon_2');
        if($benefit_icon_2){
            $ext = $benefit_icon_2->getClientOriginalExtension();
            $height = Image::make($benefit_icon_2)->height();
            $width = Image::make($benefit_icon_2)->width();
            $original = Image::make($benefit_icon_2)->fit($width, $height)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $benefit_icon_2->hashName(),  $original);
           $benefit_icon_2 = $benefit_icon_2->hashName();
        }
        
        $benefit_icon_3 = $request->file('benefit_icon_3');
        if($benefit_icon_3){
            $ext = $benefit_icon_3->getClientOriginalExtension();
            $height = Image::make($benefit_icon_3)->height();
            $width = Image::make($benefit_icon_3)->width();
            $original = Image::make($benefit_icon_3)->fit($width, $height)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $benefit_icon_3->hashName(),  $original);
           $benefit_icon_3 = $benefit_icon_3->hashName();
        }
        
        $benefit_icon_4 = $request->file('benefit_icon_4');
        if($benefit_icon_4){
            $ext = $benefit_icon_4->getClientOriginalExtension();
            $height = Image::make($benefit_icon_4)->height();
            $width = Image::make($benefit_icon_4)->width();
            $original = Image::make($benefit_icon_4)->fit($width, $height)->encode($ext, 70);
            $this->storage->put($path. 'original-' . $benefit_icon_4->hashName(),  $original);
           $benefit_icon_4 = $benefit_icon_4->hashName();
        }

        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */

        // Imagem destaque
        $isPhoto = (int)$request->isPhoto;
        
        if($isPhoto == 1) {
            $path = $record->path;
            $hashname = $record->image;
            
        }else if($isPhoto == 2){
            return back()->with('error','Não é permitido deixar o campo de logo sem arquivo. Por favor, faça o upload de uma logo');
        }
        else if($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }
        // Fim imagem destaque
        
        // Imagem interna
        $image_internal = (int)$request->isPhotoInternal;
        
        if($image_internal == 1) {
            $path = $record->path;
            $hashname_internal = $record->image_internal;
            
        }else if($image_internal == 2){
            $path = NULL;
            $hashname_internal = NULL;
        }
        else if($image_internal == 3){
            $path = $path;
            $hashname_internal = $hashname_internal;
        }
        // Fim interna
        
        
        // Benefício 1
        $field_benefit_1 = (int)$request->isPhoto_benefit_1;
        if($field_benefit_1 == 1) {
            // $path = $record->path;
            $benefit_icon_1 = $record->benefit_icon_1;
            
        }else if($field_benefit_1 == 2){
            // $path = NULL;
            // $hashname_internal = NULL;
            $benefit_icon_1 = NULL;
        }
        else if($field_benefit_1 == 3){
            $benefit_icon_1 = $benefit_icon_1;
        }
        // Fim benefício 1
        
        // Benefício 2
        $field_benefit_2 = (int)$request->isPhoto_benefit_2;
        if($field_benefit_2 == 1) {
            // $path = $record->path;
            $benefit_icon_2 = $record->benefit_icon_2;
            
        }else if($field_benefit_2 == 2){
            // $path = NULL;
            // $hashname_internal = NULL;
            $benefit_icon_2 = NULL;
        }
        else if($field_benefit_2 == 3){
            $benefit_icon_2 = $benefit_icon_2;
        }
        // Fim benefício 2
        
        // Benefício 3
        $field_benefit_3 = (int)$request->isPhoto_benefit_3;
        if($field_benefit_3 == 1) {
            // $path = $record->path;
            $benefit_icon_3 = $record->benefit_icon_3;
            
        }else if($field_benefit_3 == 2){
            // $path = NULL;
            // $hashname_internal = NULL;
            $benefit_icon_3 = NULL;
        }
        else if($field_benefit_3 == 3){
            $benefit_icon_3 = $benefit_icon_3;
        }
        // Fim benefício 3
        
        
        // Benefício 4
        $field_benefit_4 = (int)$request->isPhoto_benefit_4;
        if($field_benefit_4 == 1) {
            // $path = $record->path;
            $benefit_icon_4 = $record->benefit_icon_4;
            
        }else if($field_benefit_4 == 2){
            // $path = NULL;
            // $hashname_internal = NULL;
            $benefit_icon_4 = NULL;
        }
        else if($field_benefit_4 == 3){
            $benefit_icon_4 = $benefit_icon_4;
        }
        // Fim benefício 4

        $record->title = $request->title;
        $record->slug = \Str::slug($request->title);
        $record->description = $request->description;
        $record->content     = $request->content;
        $record->benefit_desc_1 = $request->benefit_desc_1;
        $record->benefit_desc_2 = $request->benefit_desc_2;
        $record->benefit_desc_3 = $request->benefit_desc_3;
        $record->benefit_desc_4 = $request->benefit_desc_4;
        $record->after_content = $request->after_content;
        $record->desc_form_contact = $request->desc_form_contact;
        $record->desc_form_contact = $request->desc_form_contact;
        $record->email_to = $request->email_to;
        $record->path = isset($path) ? $path : NULL;
        $record->image = isset($hashname) ? $hashname : NULL;
        $record->path_internal = isset($path) ? $path : NULL;
        $record->image_internal = isset($hashname_internal) ? $hashname_internal : NULL;
        $record->benefit_icon_1 = $benefit_icon_1;
        $record->benefit_icon_2 = $benefit_icon_2;
        $record->benefit_icon_3 = $benefit_icon_3;
        $record->benefit_icon_4 = $benefit_icon_4;
        
        $record->update();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.servico.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $servico)
    {
        $this->storage->delete($servico->path . 'original-' . $servico->image);
        $this->storage->delete($servico->path . 'original-' . $servico->image_internal);
        $this->storage->delete($servico->path . '500x400-' . $servico->image);
        $this->storage->delete($servico->path . '150x150-' . $servico->image_internal);
        $this->storage->delete($servico->path . 'original-' . $servico->benefit_icon_1);
        $this->storage->delete($servico->path . 'original-' . $servico->benefit_icon_2);
        $this->storage->delete($servico->path . 'original-' . $servico->benefit_icon_3);
        $this->storage->delete($servico->path . 'original-' . $servico->benefit_icon_4);
       
        $servico->delete();

        $notification = [
            'message' => 'Serviço deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.servico.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');
        $records = Service::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.Service.search', compact('records'));
    }
}