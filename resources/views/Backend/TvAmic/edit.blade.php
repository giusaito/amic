@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $tv->title)

@section('css')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection

@section('js')

@endsection

@section('content')


<form action="" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-9">
			<div class="card" style="padding:15px;">
				<div class="form-group">
					<label for="url_video">Url Vídeo</label>
					<input type="text" class="form-control" id="url_video" placeholder="Url do vídeo" value="{{$tv->url_video}}">
				</div>
				<div class="form-group">
					<label for="title">Título do vídeo</label>
					<input type="text" class="form-control" id="title" placeholder="Título do vídeo" value="{{$tv->title}}">
				</div>
				<div class="form-group">
					<label for="description">Descrição do vídeo</label>
					<input type="text" class="form-control" id="description" placeholder="Descrição do vídeo" value="{{$tv->description}}">
				</div>
				<div class="form-group">
					<label for="iframe">Iframe do vídeo</label>
					<input type="text" class="form-control" id="iframe" placeholder="Iframe do vídeo" value="{{$tv->iframe}}">
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="provider_name">Nome do provedor de vídeo</label>
						<input type="text" class="form-control" id="provider_name" value="{{$tv->provider_name}}">
					</div>
						<div class="form-group col-md-6">
							<label for="provider_url">Url do provedor de vídeo</label>
							<input type="text" class="form-control" id="provider_url" value="{{$tv->provider_url}}">
						</div>
				</div>
			</div>
		</div>
		
		<div class="col-3">
			<div class="card">
				<div class="card-header">
					<h5>Status</h5>
					<span>Defina se a publicação será publicada ou rascunho</span>
				</div>
				<div class="card-block">
					<select name="status" id="status" class="form-control">
						<option value="">Selecione...</option>
						<option value="PUBLISHED" {{ ($tv->status == 'PUBLISHED' ? "selected":"") }}>Publicado</option>
						<option value="DRAFT" {{ ($tv->status == 'DRAFT' ? "selected":"") }}>Rascunho</option>
					</select>
					@if($errors->first('status'))
						<label for="status" class="error">{{ $errors->first('status') }}</label>
					@endif
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5>Foto</h5>
					<span>Capa do vídeo</span>
				</div>
				<div class="card-block">
					<div class="custom-file">	
						<input type="file" name="photo" id="inputGroupFile01" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
    					<label class="custom-file-label" for="inputGroupFile01">Escolher foto</label>
					</div>
					@if($errors->first('photo'))
						<label for="photo" class="error">{{ $errors->first('photo') }}</label>
					@endif
					<div class="alert"></div>
					<div id='img_contain'>
						<img id="blah" align="middle" src="@if(file_exists(public_path("storage/$tv->path/500x500/$tv->photo"))) {{asset("storage/$tv->path/500x500/$tv->photo")}}  @else http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png @endif" alt="your image" title='' class="img-fluid" />
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection