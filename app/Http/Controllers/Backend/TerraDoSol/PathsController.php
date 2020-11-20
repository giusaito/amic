<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Paths;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PathsController extends Controller
{
    public function index(){
        $records = Paths::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Paths.index', compact('records'));
    }
}