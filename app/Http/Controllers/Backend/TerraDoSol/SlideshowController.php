<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Slideshow;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SlideshowController extends Controller
{
    public function index(){
        $records = Slideshow::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Slideshow.index', compact('records'));
    }
}