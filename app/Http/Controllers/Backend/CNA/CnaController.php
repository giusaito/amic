<?php
namespace App\Http\Controllers\Backend\CNA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\CNA\Cna;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class CnaController extends Controller
{
    private $image_ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'];
    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }

    public function index(){
        $record = Cna::first();
        return view('Backend.CNA.Cna.index', compact('record'));
    }
    public function search(Request $request){
        $search = $request->input('pesquisar');

        $records = Cna::sortable()->where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.CNA.Cna.index', compact('records'));
    }
    public function create(){
        return view('Backend.CNA.Cna.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'             => 'required|max:100',
            'logo'              => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
            'description'       => 'required'
            // 'about_foto'        => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
            // 'about_content'     => 'required'
        ],
        [
            'title.required'        => 'Você deve informar o título do CNA.',
            'title.max'             => 'O Título excedeu o limite de 100 caracteres.',
            'logo.image'            => 'A logomarca não é uma imagem',
            'logo.mimes'            => 'A logomarca deve ter o formato JPG ou PNG',
            'description.required'  => 'Você deve informar a descrição do CNA.',
        ]);

        $logo = $request->file('logo');
        if($logo){
            $ext = $logo->getClientOriginalExtension();

            $height     = Image::make($logo)->height();
            $width      = Image::make($logo)->width();
            $original   = Image::make($logo)->fit($width, $height)->encode($ext, 70);
            $thumb1     = Image::make($logo)->fit(150, 150)->encode($ext, 70);
            $path       = "terra-do-sol/img/" . date('Y/m/d/');
            $this->storage->put($path. 'original-' . $logo->hashName(),  $original);
            $this->storage->put($path. '150x150-'.  $logo->hashName(),  $thumb1);
            $hashname = $logo->hashName();
        }
        
        $record                         = new Cna;
        $record->title                  = $request->title;
        $record->description            = $request->description;
        $record->logo_path              = isset($path) ? $path : NULL;
        $record->logo                   = isset($hashname) ? $hashname : NULL;
        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.editions.index')->with($notification);
    }
    public function edit($id)
    {
        $record = Cna::find($id);
        return view('Backend.CNA.Cna.edit', compact('record'));
    }
    public function update(Request $request, $id)
    {
        $record = Cna::find($id);

        $file = $request->file('logo');
        if($file){
            $ext = $file->getClientOriginalExtension();
            $height = Image::make($file)->height();
            $width = Image::make($file)->width();
            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);
            $path = "terra-do-sol/img/" . date('Y/m/d/');
            $this->storage->put($path. 'original-' . $file->hashName(),  $original);
            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);
            $hashname = $file->hashName();
        }

        $isPhoto = (int)$request->isPhoto;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto == 1) {
            $path = $record->path;
            $hashname = $record->logo;
            
        }else if($isPhoto == 2){
            $path = NULL;
            $hashname = NULL;
        }
        else if($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }

        $record->title                  = $request->title;
        $record->subtitle               = $request->subtitle;
        $record->path                   = isset($path) ? $path : NULL;
        $record->logo                   = isset($hashname) ? $hashname : NULL;
        $record->slug                   = \Str::slug($request->title);
        $record->subscription_start     = DateTime::createFromFormat('d/m/Y', $request->subscription_start)->format('Y-m-d');
        $record->subscription_finish    = DateTime::createFromFormat('d/m/Y', $request->subscription_finish)->format('Y-m-d');
        $record->event_start            = DateTime::createFromFormat('d/m/Y', $request->event_start)->format('Y-m-d');
        $record->event_finish           = DateTime::createFromFormat('d/m/Y', $request->subscription_finish)->format('Y-m-d');
        $record->event_suspended        = $request->event_suspended == "on" ? 'true' : 'false';
        $record->event_suspended_cause  = $request->event_suspended_cause;

        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.editions.index')->with($notification);
    }
    public function destroy(Cna $edico)
    {
        $this->storage->delete($edico->path . 'original-' . $edico->logo);
        $this->storage->delete($edico->path . '150x150-' . $edico->logo);
       
        $edico->delete();

        $notification = [
            'message' => 'Edição excluída com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.editions.index')->with($notification);
    }
}