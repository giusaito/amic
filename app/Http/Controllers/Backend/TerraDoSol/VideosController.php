<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Video;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class VideosController extends Controller
{
    private $image_ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF'];

    public function __construct()
    {
      $this->storage = Storage::disk('public');
    }
    public function index(Edition $edicao){
        $records = Video::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Videos.index', compact('edicao','records'));
    }
    public function create(Edition $edicao)
    {
        return view('Backend.TerraDoSol.Videos.create', compact('edicao'));
    }

    public function store(Request $request, Edition $edicao)
    {
        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();
            $height = Image::make($file)->height();
            $width = Image::make($file)->width();
            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);
            $path = "ts_videos/" . date('Y/m/d/');
            $this->storage->put($path. 'original-' . $file->hashName(),  $original);
            $this->storage->put($path. '150x150-'.  $file->hashName(),  $thumb1);
            $hashname = $file->hashName();
        }

        $record = new Video();
        $record->ts_edition_id  = $edicao->id;
        $record->path        = isset($path) ? $path : NULL;
        $record->thumbnail   = isset($hashname) ? $hashname : NULL;
        $record->video       = $request->video;

        $record->save();

        $notification = [
            'message' => 'O vídeo foi adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.videos.index', ['edicao' => $edicao->id])->with($notification);
    }

    public function show($id)
    {
        
    }

    public function edit(Edition $edicao, $id)
    {
        $record = Video::find($id);
        return view('Backend.TerraDoSol.Videos.edit', compact('record','edicao'));

    }

    public function update(Request $request, Edition $edicao, $id)
    {
        $video = Video::find($id);

        $file = $request->file('feature_image');
        if($file){
            $ext = $file->getClientOriginalExtension();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();
            $original = Image::make($file)->fit($width, $height)->encode($ext, 70);
            $thumb1   = Image::make($file)->fit(150, 150)->encode($ext, 70);
            $path = "ts_videos/" . date('Y/m/d/');
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
            $path = $video->path;
            $hashname = $video->thumbnail;
            
        }else if($isPhoto == 2){
            $path = NULL;
            $hashname = NULL;
        }
        else if($isPhoto == 3){
            $path = $path;
            $hashname = $hashname;
        }
        if(isset($hashname) && isset($path)){
            $video->path = isset($path) ? $path : NULL;
            $video->thumbnail = isset($hashname) ? $hashname : NULL;
        }
        $video->video = $request->video;

        $video->update();
        
        $notification = [
            'message' => 'O vídeo foi atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.videos.index', ['edicao' => $edicao->id])->with($notification);
    }

    public function destroy(Edition $edicao, Video $video)
    {
       $this->storage->delete($video->path . 'original-' . $video->image);
       $this->storage->delete($video->path . '150x150-' . $video->image);
       $video->delete();

        $notification = [
            'message' => 'Vídeo deletado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.videos.index', ['edicao' => $edicao->id])->with($notification);
    }

    public function search(Request $request){
        $search = $request->input('pesquisar');

        $record = Video::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('video', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Videos.search', compact('record'));

    }
}