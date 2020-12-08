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
            'description'       => 'required',
            'imagem_destaque'   => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
        ],
        [
            'title.required'        => 'Você deve informar o título do CNA.',
            'title.max'             => 'O Título excedeu o limite de 100 caracteres.',
            'logo.image'            => 'A logomarca não é uma imagem',
            'logo.mimes'            => 'A logomarca deve ter o formato JPG ou PNG',
            'description.required'  => 'Você deve informar a descrição do CNA.',
            'imagem_destaque.image' => 'O arquivo não é uma imagem',
            'imagem_destaque.mimes' => 'O arquivo deve ter o formato JPG ou PNG',
        ]);

        $record = Cna::first();
        if(!$record){
            $record  = new Cna;
        }
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

        $imagem_destaque = $request->file('imagem_destaque');
        if($imagem_destaque){
            $ext = $imagem_destaque->getClientOriginalExtension();

            $height               = Image::make($imagem_destaque)->height();
            $width                = Image::make($imagem_destaque)->width();
            $original             = Image::make($imagem_destaque)->fit($width, $height)->encode($ext, 70);
            $thumb1               = Image::make($imagem_destaque)->fit(150, 150)->encode($ext, 70);
            $imagem_destaque_path = "terra-do-sol/img/" . date('Y/m/d/');
            $this->storage->put($imagem_destaque_path. 'original-' . $imagem_destaque->hashName(),  $original);
            $this->storage->put($imagem_destaque_path. '150x150-'.  $imagem_destaque->hashName(),  $thumb1);
            $imagem_destaque_hashname = $imagem_destaque->hashName();
        }

        $isPhoto2 = (int)$request->isPhoto2;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto2 == 1) {
            $imagem_destaque_path = $record->imagem_destaque_path;
            $imagem_destaque_hashname = $record->imagem_destaque;
            
        }else if($isPhoto2 == 2){
            $imagem_destaque_path = NULL;
            $imagem_destaque_hashname = NULL;
        }
        else if($isPhoto2 == 3){
            $imagem_destaque_path = $imagem_destaque_path;
            $imagem_destaque_hashname = $imagem_destaque_hashname;
        }
        $record->title                  = $request->title;
        $record->description            = $request->description;
        $record->logo_path              = isset($path) ? $path : NULL;
        $record->logo                   = isset($hashname) ? $hashname : NULL;
        $record->imagem_destaque_path   = isset($imagem_destaque_path) ? $imagem_destaque_path : NULL;
        $record->imagem_destaque        = isset($imagem_destaque_hashname) ? $imagem_destaque_hashname : NULL;
        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.cna.index')->with($notification);
    }
    public function about(){
        $record = Cna::first();
        return view('Backend.CNA.About.index', compact('record'));
    }
    public function aboutstore(Request $request)
    {
        $this->validate($request, [
            'about_foto'        => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
            'about_content'     => 'required'
        ],
        [
            'about_content.required' => 'Você deve informar o conteúdo.',
            'about_foto.image'       => 'O arquivo não é uma imagem',
            'about_foto.mimes'       => 'O arquivo deve ter o formato JPG ou PNG',
        ]);

        $record = Cna::first();
        if(!$record){
            $record  = new Cna;
        }

        $about_foto = $request->file('about_foto');
        if($about_foto){
            $ext = $about_foto->getClientOriginalExtension();

            $height               = Image::make($about_foto)->height();
            $width                = Image::make($about_foto)->width();
            $original             = Image::make($about_foto)->fit($width, $height)->encode($ext, 70);
            $thumb1               = Image::make($about_foto)->fit(150, 150)->encode($ext, 70);
            $about_foto_path = "terra-do-sol/img/" . date('Y/m/d/');
            $this->storage->put($about_foto_path. 'original-' . $about_foto->hashName(),  $original);
            $this->storage->put($about_foto_path. '150x150-'.  $about_foto->hashName(),  $thumb1);
            $about_foto_hashname = $about_foto->hashName();
        }

        $isPhoto2 = (int)$request->isPhoto2;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto2 == 1) {
            $about_foto_path = $record->about_foto_path;
            $about_foto_hashname = $record->about_foto;
            
        }else if($isPhoto2 == 2){
            $about_foto_path = NULL;
            $about_foto_hashname = NULL;
        }
        else if($isPhoto2 == 3){
            $about_foto_path = $about_foto_path;
            $about_foto_hashname = $about_foto_hashname;
        }
        $record->about_content     = $request->about_content;
        $record->about_foto_path   = isset($about_foto_path) ? $about_foto_path : NULL;
        $record->about_foto        = isset($about_foto_hashname) ? $about_foto_hashname : NULL;
        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.cna.about.index')->with($notification);
    }
}