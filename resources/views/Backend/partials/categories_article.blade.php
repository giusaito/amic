<li style="display: list-item;" class="mjs-nestedSortable-branch mjs-nestedSortable-expanded" id="menuItem_{{ $record['id'] }}" data-foo="{{ $record['slug'] }}">
	<div class="menuDiv">
		<span title="Clique para exibir/esconder a subcategoria" class="disclose ui-icon ui-icon-minusthick">
		<span></span>
		</span>
		{{-- <span title="Clique para exibir/esconder a categoria" data-id="{{ $record['id'] }}" class="expandEditor ui-icon ui-icon-triangle-1-n"> --}}
		<span></span>
		</span>
		<span>
		<span data-id="{{ $record['id'] }}" class="itemTitle">{{ $record['title'] }}</span>
		<span title="Clique para excluir a categoria." data-id="{{ $record['id'] }}" class="deleteMenu ui-icon ui-icon-closethick">
			<span></span>
		</span>
		<span title="Clique para editar a categoria." data-id="{{ $record['id'] }}" class="editMenu ui-icon ui-icon-document">
			<span></span>
		</span>
		</span>
		<div id="menuEdit2" class="menuEdit hidden">
			<p>
				{{ $record['description'] }}
			</p>
		</div>
	</div>
	@if (count($record['children']) > 0)
	    <ol>
	    @foreach($record['children'] as $record)
	        @include('Backend.partials.categories_article', $record)
	    @endforeach
	    </ol>
	@endif
</li>