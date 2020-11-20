<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\About;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index(){
        $records = About::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.About.index', compact('records'));
    }
}