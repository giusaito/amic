<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Recomendation;
use DateTime;
use Carbon\Carbon;

class RecomendationsController extends Controller
{
    public function index(Edition $edicao){
        $record = Recomendation::where(['ts_edition_id'=> $edicao->id])->first();
        return view('Backend.TerraDoSol.Recomendations.index', compact('edicao','record'));
    }
    public function store(Request $request, Edition $edicao){
        $edicao = Edition::with('recomendacao')->where(['id'=>$edicao->id])->first();
        if($edicao->recomendacao){
            $record = Recomendation::find($edicao->recomendacao['id']);
        }else {
            $record  = new Recomendation;
        }

        $record->ts_edition_id  = $edicao->id;
        $record->content        = $request->content;

        $record->save();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.editions.index')->with($notification);
    }
}