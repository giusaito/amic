<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EditionsController extends Controller
{
    public function index(){
        $records = Edition::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Editions.index', compact('records'));
    }
}