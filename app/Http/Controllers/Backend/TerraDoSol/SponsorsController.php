<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Sponsor;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SponsorsController extends Controller
{
    public function index(){
        $records = Sponsor::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Sponsors.index', compact('records'));
    }
}