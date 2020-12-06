<section id="news-related" class="mt-5">
	<div class="mp-4">
		<h3><strong><span>|</span> Relacionadas</strong></h3>
		 <div class="row">  
		 @foreach($relateds as $related)      
	        <div class="col-4">
	        	<a href="{{route('frontend.article.view', ['id' => $related->id, 'slug' => $article->slug])}}">
	            	<img src="{{asset('storage')}}/{{$related->path}}150x150-{{$related->image}}" class="img-fluid">
	            </a>
	        </div>
	        <div class="col-8 mt-4">
	        	<a href="{{route('frontend.article.view', ['id' => $related->id, 'slug' => $article->slug])}}">
	          		<p><strong>{{$related->title}}</strong></p>
	            	<small>{{$related->editorias[0]->title}} 
	            		<i class="far fa-calendar-alt"></i>
	            		{{date('d/m/Y', strtotime($related->published_at))}} 
	            		às 
	            		<i class="far fa-clock"></i> 
	            		{{date('H:m', strtotime($related->published_at))}}
	            </small>
	          </a>
	        </div>
	    @endforeach
   </div>
	</div>
</section>