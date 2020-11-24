<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Picture;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PicturesController extends Controller
{
    public function index(Edition $edicao){
        $records = Picture::orderBy('id', 'desc')->get();
        return view('Backend.TerraDoSol.Pictures.index', compact('edicao','records'));
    }
}