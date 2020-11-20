<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Recomendations;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RecomendationsController extends Controller
{
    public function index(){
        $records = Recomendations::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Recomendations.index', compact('records'));
    }
}