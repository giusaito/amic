<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Picture;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class PicturesController extends Controller
{
    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }
    public function index(Edition $edicao){
        $records = Picture::where(['ts_edition_id'=> $edicao->id])->orderBy('id', 'desc')->get();
        return view('Backend.TerraDoSol.Pictures.index', compact('edicao','records'));
    }
    public function store(Request $request, Edition $edicao)
    {
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
        $record                 = new Picture;
        $record->ts_edition_id  = $edicao->id;
        $record->path           = $path;
        $record->image          = $hashname;
        $record->save();

        return response()->json([
            'initialPreview' => ['/storage/'.$path. 'original-' . $hashname],
            'initialPreviewConfig' => [
                ['key' => $record->id, 'exif' => $this->storage->path($path. 'original-' . $hashname)]
            ]
        ]);
    }
    public function destroy(Request $request)
    {
        $record = Picture::find($request->key);
        if($record->delete()){
            $this->storage->delete($record->path . 'original-' . $record->image);
            return response()->json(['success'=>'Removido']);
        }else {
            return response()->json(['error'=>'Houve um problema para excluir a imagem! por favor, tente novamente!']);
        }
    }
}