<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Video;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    public function index(){
        $records = Paths::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Videos.index', compact('records'));
    }
}