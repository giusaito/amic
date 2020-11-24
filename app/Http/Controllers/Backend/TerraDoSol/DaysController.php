<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Day;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DaysController extends Controller
{
    public function index(Edition $edicao){
        $records = Day::sortable()->orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Days.index', compact('edicao','records'));
    }
    public function search(Request $request, Edition $edicao){
        $search = $request->input('pesquisar');

        $records = Day::sortable()->where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Days.index', compact('edicao', 'records'));
    }
    public function create(Edition $edicao){
        return view('Backend.TerraDoSol.Days.create', compact('edicao'));
    }
    public function store(Request $request, Edition $edicao)
    {

        $this->validate($request, [
            'title'                 => 'required',
            'content'               => 'required'
        ],
        [
            'title.required'              => 'Você deve informar o Título.',
            'content.required'            => 'Você deve informar o Conteúdo.'
        ]);
        
        $record                     = new Day;
        $record->ts_edition_id      = $edicao->id;
        $record->title              = $request->title;
        $record->content            = $request->content;
        $record->ambient_conditions = $request->ambient_conditions;
        $record->save();

        $notification = [
            'message' =>  $record->content . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.days.index', ['edicao' => $edicao->id])->with($notification);
    }
    public function edit(Edition $edicao, $id)
    {
        $record = Day::find($id);
        return view('Backend.TerraDoSol.Days.edit', compact('edicao', 'record'));
    }
    public function update(Request $request, Edition $edicao, $id)
    {
        $record = Day::find($id);

        $record->title = $request->title;
        $record->content = $request->content;
        $record->ambient_conditions = $request->ambient_conditions;
        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.days.index', ['edicao' => $edicao->id, 'id'=>$id])->with($notification);
    }
    public function destroy(Edition $edicao, Day $day)
    {
        $day->delete();

        $notification = [
            'message' => 'Item excluído com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.days.index', ['edicao' => $edicao->id])->with($notification);
    }
}