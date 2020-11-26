<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Sponsor;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SponsorsController extends Controller
{
    public function index(Edition $edicao){
        $records = Sponsor::orderBy('id', 'desc')->get();
        return view('Backend.TerraDoSol.Sponsors.index', compact('edicao','records'));
    }
    public function search(Request $request, Edition $edicao){
        $search = $request->input('pesquisar');

        $records = Sponsor::where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('content', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Sponsor.index', compact('edicao', 'records'));
    }
    public function create(Edition $edicao){
        return view('Backend.TerraDoSol.Sponsor.create', compact('edicao'));
    }
    public function store(Request $request, Edition $edicao)
    {
        $this->validate($request, [
            'content'   => 'required'
        ],
        [
            'content.required' => 'Você deve informar o Item.'
        ]);
        
        $record                 = new Sponsor;
        $record->ts_edition_id  = $edicao->id;
        $record->content        = $request->content;
        $record->save();

        $notification = [
            'message' =>  $record->content . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.checklist.index', ['edicao' => $edicao->id])->with($notification);
    }
    public function edit(Edition $edicao, $id)
    {
        $record = Sponsor::find($id);
        return view('Backend.TerraDoSol.Sponsor.edit', compact('edicao', 'record'));
    }
    public function update(Request $request, Edition $edicao, $id)
    {
        $record = Sponsor::find($id);

        $record->content = $request->content;
    
        $record->update();

        $notification = [
            'message' =>  $record->content . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.checklist.index', ['edicao' => $edicao->id, 'id'=>$id])->with($notification);
    }
    public function destroy(Edition $edicao, Sponsor $checklist)
    {
        $checklist->delete();

        $notification = [
            'message' => 'Item excluído com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.checklist.index', ['edicao' => $edicao->id])->with($notification);
    }
}