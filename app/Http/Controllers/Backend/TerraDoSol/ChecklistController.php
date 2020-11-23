<?php
namespace App\Http\Controllers\Backend\TerraDoSol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\TerraDoSol\Edition;
use App\Http\Models\TerraDoSol\Checklist;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ChecklistController extends Controller
{
    public function index(Edition $edicao){
        $records = Checklist::orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Checklist.index', compact('edicao','records'));
    }
    public function search(Request $request){
        $search = $request->input('pesquisar');

        $records = Checklist::sortable()->where(function($query) use($search){
            $searchWildcard = '%' . $search . '%';
            $query->orWhere('title', 'LIKE', $searchWildcard);
        })->orderBy('id', 'desc')->paginate(10);
        return view('Backend.TerraDoSol.Checklist.index', compact('records'));
    }
    public function create(Edition $edicao){
        return view('Backend.TerraDoSol.Checklist.create');
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'content'   => 'required'
        ],
        [
            'content.required' => 'Você deve informar o nome da Edição.'
        ]);
        
        $record                         = new Checklist;
        $record->content                  = $request->content;
        $record->save();

        $notification = [
            'message' =>  $record->title . ' adicionado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.checklist.index')->with($notification);
    }
    public function edit($id)
    {
        $record = Checklist::find($id);
        return view('Backend.TerraDoSol.Checklist.edit', compact('record'));
    }
    public function update(Request $request, $id)
    {
        $record = Checklist::find($id);

        $record->content                  = $request->content;
    
        $record->update();

        $notification = [
            'message' =>  $record->title . ' atualizado com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.checklist.index')->with($notification);
    }
    public function destroy(Checklist $checklist, Edition $edicao)
    {
        $checklist->delete();

        $notification = [
            'message' => 'Item excluído com sucesso',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.ts.checklist.index')->with($notification);
    }
}