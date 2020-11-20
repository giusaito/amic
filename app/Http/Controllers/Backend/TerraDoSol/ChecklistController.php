<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Checklist;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ChecklistController extends Controller
{
    public function index(){
        $records = Checklist::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Checklist.index', compact('records'));
    }
}