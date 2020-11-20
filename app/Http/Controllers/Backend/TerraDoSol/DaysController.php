<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Days;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DaysController extends Controller
{
    public function index(){
        $records = Days::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Days.index', compact('records'));
    }
}