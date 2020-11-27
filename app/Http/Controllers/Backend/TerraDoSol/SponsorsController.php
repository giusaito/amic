<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Sponsor;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class SponsorsController extends Controller
{
    private $image_ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'];
    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }
    public function index(Edition $edicao){
        $records = Sponsor::orderBy('id', 'desc')->get();
        return view('Backend.TerraDoSol.Sponsors.index', compact('edicao','records'));
    }
    public function search(Request $request, Edition $edicao){
        $search = $request->input('pesquisar');

        $records = Sponsor::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Sponsors.index', compact('edicao', 'records'));
    }
    public function create(Edition $edicao){
        return view('Backend.TerraDoSol.Sponsors.create', compact('edicao'));
    }
    public function store(Request $request, Edition $edicao)
    {
        $this->validate($request, [
            'title'   => 'required',
            'file'       => 'nullable|sometimes|image|mimes:jpeg,png,jpg'
        ],
        [
            'title.required' => 'Você deve informar o nome do Patrocinador.',
            'file.image'     => 'A logomarca não é uma imagem',
            'file.mimes'     => 'A logomarca deve ter o formato JPG ou PNG'
        ]);

        $file = $request->file('file');
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
        $record                 = new Sponsor;
        $record->ts_edition_id  = $edicao->id;
        $record->path           = $path;
        $record->logo           = $hashname;
        $record->title          = $request->title;
        $record->slug           = \Str::slug($request->title);
        $record->url            = $request->url;
        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.sponsors.index', ['edicao' => $edicao->id])->with($notification);
    }
    public function edit(Edition $edicao, $id)
    {
        $record = Sponsor::find($id);
        return view('Backend.TerraDoSol.Sponsors.edit', compact('edicao', 'record'));
    }
    public function update(Request $request, Edition $edicao, $id)
    {

        $record = Sponsor::find($id);

        $file = $request->file('file');
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
        $record->url                    = $request->url;
        if(isset($hashname) && isset($path)){
            $record->path               = isset($path) ? $path : NULL;
            $record->logo               = isset($hashname) ? $hashname : NULL;
        }
        $record->slug                   = \Str::slug($request->title);

        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.sponsors.index', ['edicao' => $edicao->id])->with($notification);
    }
    public function destroy(Edition $edicao, Sponsor $sponsor)
    {
        $this->storage->delete($sponsor->path . 'original-' . $sponsor->logo);
        $this->storage->delete($sponsor->path . '150x150-' . $sponsor->logo);
       
        $sponsor->delete();

        $notification = [
            'message' => 'Patrocinador excluído com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.sponsors.index', ['edicao' => $edicao->id])->with($notification);
    }
}