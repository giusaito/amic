<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Pictures;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PicturesController extends Controller
{
    public function index(){
        $records = Pictures::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Pictures.index', compact('records'));
    }
}