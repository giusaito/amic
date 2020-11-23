<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\About;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class AboutController extends Controller
{
    private $image_ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'];
    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }
    public function index(Edition $edicao){
        $record = About::where(['ts_edition_id'=> $edicao->id])->first();
        return view('Backend.TerraDoSol.About.index', compact('edicao','record'));
    }
    public function store(Request $request, Edition $edicao){
        $edicao = Edition::with('sobre')->where(['id'=>$edicao->id])->first();
        if($edicao->sobre){
            $record = About::find($edicao->sobre['id']);
        }else {
            $record  = new About;
        }
        // dd($record->sobre);

        /*
        * FOTO 1
        */
        $image1 = $request->file('image1');
        if($image1){
            $ext = $image1->getClientOriginalExtension();
            $height = Image::make($image1)->height();
            $width = Image::make($image1)->width();
            $original = Image::make($image1)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($image1)->fit(150, 150)->encode($ext, 70);
            $path1 = "terra-do-sol/img/" . date('Y/m/d/');
            $this->storage->put($path1. 'original-' . $image1->hashName(),  $original);
            $this->storage->put($path1. '150x150-'.  $image1->hashName(),  $thumb1);
            $hashname1 = $image1->hashName();
        }
        $isPhoto1 = (int)$request->isPhoto1;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto1 == 1) {
            $path1 = $record->path1;
            $hashname1 = $record->image1;
            
        }else if($isPhoto1 == 2){
            $path1 = NULL;
            $hashname1 = NULL;
        }
        else if($isPhoto1 == 3){
            $path1 = $path1;
            $hashname1 = $hashname1;
        }

        /*
        * FOTO 2
        */
        $image2 = $request->file('image2');
        if($image2){
            $ext = $image2->getClientOriginalExtension();
            $height = Image::make($image2)->height();
            $width = Image::make($image2)->width();
            $original = Image::make($image2)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($image2)->fit(150, 150)->encode($ext, 70);
            $path2 = "terra-do-sol/img/" . date('Y/m/d/');
            $this->storage->put($path2. 'original-' . $image2->hashName(),  $original);
            $this->storage->put($path2. '150x150-'.  $image2->hashName(),  $thumb1);
            $hashname2 = $image2->hashName();
        }
        $isPhoto2 = (int)$request->isPhoto2;
        /* 1 A foto não foi alterada
           2 Foto deletada
           3 Foto alterada 
        */
        if($isPhoto2 == 1) {
            $path2 = $record->path2;
            $hashname2 = $record->image2;
            
        }else if($isPhoto2 == 2){
            $path2 = NULL;
            $hashname2 = NULL;
        }
        else if($isPhoto2 == 3){
            $path2 = $path2;
            $hashname2 = $hashname2;
        }

        $record->ts_edition_id  = $edicao->id;
        $record->title          = $request->title;
        $record->content        = $request->content;
        $record->path1          = isset($path1) ? $path1 : NULL;
        $record->image1         = isset($hashname1) ? $hashname1 : NULL;
        $record->path2          = isset($path2) ? $path1 : NULL;
        $record->image2         = isset($hashname2) ? $hashname2 : NULL;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.editions.index')->with($notification);
    }
}