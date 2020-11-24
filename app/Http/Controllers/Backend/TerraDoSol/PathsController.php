<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Path;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class PathsController extends Controller
{
    private $image_ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'];
    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }
    public function index(Edition $edicao){
        $record = Path::where(['ts_edition_id'=> $edicao->id])->first();
        return view('Backend.TerraDoSol.Paths.index', compact('edicao','record'));
    }
    public function store(Request $request, Edition $edicao){
        $edicao = Edition::with('trajeto')->where(['id'=>$edicao->id])->first();
        if($edicao->trajeto){
            $record = Path::find($edicao->trajeto['id']);
        }else {
            $record  = new Path;
        }

        /*
        * MAPA
        */
        $map = $request->file('map');
        if($map){
            $ext = $map->getClientOriginalExtension();
            $height = Image::make($map)->height();
            $width = Image::make($map)->width();
            $original = Image::make($map)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($map)->fit(150, 150)->encode($ext, 70);
            $path = "terra-do-sol/img/" . date('Y/m/d/');
            $this->storage->put($path. 'original-' . $map->hashName(),  $original);
            $this->storage->put($path. '150x150-'.  $map->hashName(),  $thumb1);
            $hashname = $map->hashName();
        }
        $isPhoto = (int)$request->isPhoto;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto == 1) {
            $path = $record->path;
            $hashname = $record->map;
            
        }else if($isPhoto == 2){
            $path = NULL;
            $hashname = NULL;
        }
        else if($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }

        $record->ts_edition_id  = $edicao->id;
        $record->video          = $request->video;
        $record->path           = isset($path) ? $path : NULL;
        $record->map            = isset($hashname) ? $hashname : NULL;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.editions.index')->with($notification);
    }
}