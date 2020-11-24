@extends('Backend.Layouts.layout')
@section('title', 'Categorias de Notícias')
@section('content')
<section id="noticias">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Notícias &raquo; Categorias</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/painel">Painel</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('backend.noticia.index')}}">Notícias</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Categorias</strong>
                </li>
            </ol>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="ibox-title">
                        <h5>Lista de Categorias cadastradas</h5>
                        <div class="ibox-tools">
                            <a href="{{route('backend.category.noticias.create')}}/" class="btn btn-primary btn-sm right">
                                <i class="fa fa-plus"></i> 
                                Adicionar
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                            @if (count($records) > 0)
                                <ol class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded">
                                @foreach ($records->toTree() as $record)
                                    @include('Backend.partials.categories_article', $record)
                                @endforeach
                                </ol>
                            @else
                                @include('Backend.partials.categories_article-none')
                            @endif
                            {{-- @each('Backend.partials.categories_article', $records->toTree(), 'record', 'partials.categories_article-none') --}}
                        <button id="saveOrder" class="btn btn-primary mb-3">
                            <i class="fa fa-refresh"></i> 
                            Atualizar
                        </button>
                        <div class="result"></div>
                        <pre id="toArrayOutput">
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<style>
.form-control, .single-line {
    border-radius:5px;
}
ul.tagit input[type="text"] {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: none;
    margin: 0;
    padding: 0;
    width: inherit;
    background-color: inherit;
    outline: none;
}

.temaAtivo {
  border: 3px solid #f78900;
}

input.ui-widget-content.ui-autocomplete-input, span.tagit-label, .ui-menu-item-wrapper {
  text-transform: uppercase;
}


.mjs-nestedSortable-error {
    background: #fbe3e4;
    border-color: transparent;
}

#tree {
    width: 550px;
    margin: 0;
}

ol {
    max-width: 100%;
    padding-left: 25px;
}

ol.sortable,ol.sortable ol {
    list-style-type: none;
}

.sortable li div {
    border: 1px solid #d4d4d4;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    cursor: move;
    border-color: #D4D4D4 #D4D4D4 #BCBCBC;
    margin: 0;
    padding: 3px;
}

li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
    border-color: #999;
}

.disclose, .expandEditor {
    cursor: pointer;
    width: 20px;
    display: none;
}

.sortable li.mjs-nestedSortable-collapsed > ol {
    display: none;
}

.sortable li.mjs-nestedSortable-branch > div > .disclose {
    display: inline-block;
}

.sortable span.ui-icon {
    display: inline-block;
    margin: 0;
    padding: 0;
}

.menuDiv {
    background: #EBEBEB;
}

.menuEdit {
    background: #FFF;
}

.itemTitle {
    vertical-align: middle;
    cursor: pointer;
}

.deleteMenu, .editMenu {
    float: right;
    cursor: pointer;
}

#saveOrder {
    display: none;
}

</style>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/nestedSortable/2.0.0/jquery.mjs.nestedSortable.min.js"></script>
<script>
    $().ready(function(){
        var ns = $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            handle: 'div',
            helper:	'clone',
            items: 'li',
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            maxLevels: 4,
            isTree: true,
            expandOnHover: 700,
            startCollapsed: false,
            change: function(){
                console.log('Relocated item');
            }
        });

        $( ".sortable li" ).droppable({
            drop: function( ) {
                $('#saveOrder').css('display','inline-block');
            }
        });
        
        $('.expandEditor').attr('title','Click to show/hide item editor');
        $('.disclose').attr('title','Click to show/hide children');
        $('.deleteMenu').attr('title', 'Click to delete item.');
    
        $('.disclose').on('click', function() {
            $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
            $(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
        });
        
        $('.expandEditor, .itemTitle').click(function(){
            var id = $(this).attr('data-id');
            $('#menuEdit'+id).toggle();
            $(this).toggleClass('ui-icon-triangle-1-n').toggleClass('ui-icon-triangle-1-s');
        });
        
        $('.deleteMenu').click(function(){
            var id = $(this).attr('data-id');
            $('#menuItem_'+id).remove();
        });
            
        // $('#serialize').click(function(){
        //     serialized = $('ol.sortable').nestedSortable('serialize');
        //     $('#serializeOutput').text(serialized+'\n\n');
        // })

        // $('#toHierarchy').click(function(e){
        //     hiered = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});
        //     hiered = dump(hiered);
        //     (typeof($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
        //     $('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;
        // })

        $('#saveOrder').click(function(e){
            arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
            console.log(arraied);
            // $.post( "{{route('backend.category.noticias.saveOrder')}}", function( data ) {
            //     $( ".result" ).html( data );
            // });

            $.post("{{route('backend.category.noticias.saveOrder')}}",
                { 
                    _token: $('meta[name=csrf-token]').attr('content'),
                     _method : 'POST', 
                     data :  arraied
                }, function(response){
                    if(response != '')
                    {
                        $( ".result" ).html( data );
                    }
                });

            // arraied = dump(arraied);
            // (typeof($('#toArrayOutput')[0].textContent) != 'undefined') ?
            // $('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
        });

        // function dump(arr,level) {
		// 	var dumped_text = "";
		// 	if(!level) level = 0;
	
		// 	//The padding given at the beginning of the line.
		// 	var level_padding = "";
		// 	for(var j=0;j<level+1;j++) level_padding += "    ";
	
		// 	if(typeof(arr) == 'object') { //Array/Hashes/Objects
		// 		for(var item in arr) {
		// 			var value = arr[item];
	
		// 			if(typeof(value) == 'object') { //If it is an array,
		// 				dumped_text += level_padding + "'" + item + "' ...\n";
		// 				dumped_text += dump(value,level+1);
		// 			} else {
		// 				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
		// 			}
		// 		}
		// 	} else { //Strings/Chars/Numbers etc.
		// 		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
		// 	}
		// 	return dumped_text;
		// }
    });
</script>
@endsection
@include('Backend.Includes.toast')