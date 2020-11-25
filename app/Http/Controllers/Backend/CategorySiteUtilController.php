<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\CategorySiteUtil;

class CategorySiteUtilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        if(!$id){
            $editoria = null;
        }else {
            $editoria = CategorySiteUtil::where(['id'=>$id])->first();
        }
        $search = false;
        if ($request->has('q')) {
            $search = true;
            $q = $request->input('q');
            $editorias = CategorySiteUtil::search($q)->orderBy('created_at','desc')->get();
        }else {
            $editorias = CategorySiteUtil::orderBy('created_at','desc')->get();
        }

        return view('Backend.SiteUtil.Category.index', compact('editorias','editoria'));
    }
    public function create()
    {
        $editorias = CategorySiteUtil::orderBy('created_at','desc')->get();
        return view('Backend.SiteUtil.Category.create', compact('editorias'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      => 'required|unique:category_articles|max:100',
        ],
        [
            'title.required' => 'Você deve informar o nome da Categoria.',
            'title.unique'   => 'Já existe uma editoria com este nome. Por favor, escolha outro.',
            'title.max'      => 'O nome da Editoria excedeu o limite de 100 caracteres.'
        ]);

        $add = new CategorySiteUtil;
        if($request->parent_id > 0){
            $parent = CategorySiteUtil::findOrFail($request->parent_id);
        }
        $add->title       = $request->title;
        $add->description = $request->description;
        $add->slug        = str_slug($request->title);
        if($request->parent_id > 0){
            $add->appendToNode($parent)->save();
        }else {
            $add->save();
        }

        $notification = array(
            'message' => 'A Editoria foi adicionada com sucesso!',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.category.site.util.index')->with($notification);
    }
    public function saveOrder(Request $request){
        $this->saveOrderByArray($request['data']);
        //saveOrderByArray
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'      => 'required|max:100|unique:category_articles,title,'.$id,
        ],
        [
            'title.required'     => 'Você deve informar o nome da Editoria.',
            'title.unique'       => 'Já existe uma editoria com este nome. Por favor, escolha outro.',
            'title.max'          => 'O nome da Editoria excedeu o limite de 100 caracteres.',
        ]);

        $record   = CategorySiteUtil::findOrFail($id);

        if($request->parent > 0){
            $parent = CategorySiteUtil::findOrFail($request->parent);
        }

        $dados = [
            'title'  => $request->title,
            'slug'   => \Str::slug($request->title)
        ];

        if($request->parent > 0){
            $record->appendToNode($parent)->update($dados);
        }else {
            $record->makeRoot()->update($dados);
        }

        $notification = array(
            'message' => 'A Editoria foi editada com sucesso!',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.category.site.util.index')->with($notification);
    }
    public function destroy($id)
    {
       CategorySiteUtil::find($id)->delete();

       $notification = array(
            'message' => 'A Editoria foi deletada com sucesso!',
            'alert-type' => 'success'
        );

        return redirect()->route('backend.category.site.util.index')->with($notification);
    }

    /**
     * a method to get the children by order
     * @param string $orderBy
     * @return type
     */
    public static function saveOrderByArray($data_array)
    {
        self::_updateTreeRoots($data_array);
        self::_rebuildTree($data_array);
    }
    /**
     * Save roots only
     * @param type $data_array
     * @return type
     */
    public static function _updateTreeRoots($data_array)
    {
        if (is_array($data_array)) {
            foreach ($data_array as $data_node) {
                $node = CategorySiteUtil::find(3);
                $node->parent_id = null;
                $node->update();
            }
        }
    }
    /**
     * Rebuilds the tree: update descendants and their order
     * @param type $data_array
     * @return type
     */
    public static function _rebuildTree($data_array)
    {
        if (is_array($data_array)) {
            foreach ($data_array as $data_node) {
                $node = CategorySiteUtil::find(3);
                //loop recursively through the children
                if (isset($data_node['children']) && is_array($data_node['children'])) {
                    foreach ($data_node['children'] as $data_node_child) {
                        //append the children to their (old/new)parents
                        $descendant = CategorySiteUtil::find($data_node_child['item_id']);
                        $descendant->appendTo($node)->update();
                        //ordering trick here, shift the descendants to the bottom to get the right order at the end
                        $shift = count($descendant->getSiblings());
                        $descendant->down($shift);
                        self::_rebuildTree($data_node['children']);
                    }
                }
            }
        }
    }
}
