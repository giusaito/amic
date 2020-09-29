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
				<div class="form-group">
					<div class="form-check">
							   <b-form-checkbox switch size="lg">Large</b-form-checkbox>



					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary float-right">Editar</button>
		</div>
		

		


		<div class="col-3">
			<div class="card">
				<div class="card-header">
					<h5>Agendar</h5>
					<span>Agendar publicação</span>
				</div>
				<div class="card-block">
					<div class="form-group">
		                <div class="input-group date" id="published_at" data-target-input="nearest">
		                    <input type="text" name="published_at" class="form-control datetimepicker-input" data-target="#published_at" value="{{date("d-m-Y H:i", strtotime($tv->published_at))}}">
		                    <div class="input-group-append" data-target="#published_at" data-toggle="datetimepicker">
		                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
		                    </div>
		                </div>
		            </div>
					@if($errors->first('published_at'))
						<label for="published_at" class="error">{{ $errors->first('published_at') }}</label>
					@endif
				</div>
			</div>

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
					<h5>Cidades</h5>
					<span>Cidade(s) que este artigo pertence</span>
				</div>
				<div class="card-block">
					<div class="border-checkbox-section">
						
						@if($errors->first('cidade'))
							<label for="cidade" class="error">{{ $errors->first('cidade') }}</label>
						@endif
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5>Editorias</h5>
					<span>Editoria(s) que este artigo pertence</span>
				</div>
				<div class="card-block">
					<div class="border-checkbox-section">
						
						@if($errors->first('editoria'))
							<label for="editoria" class="error">{{ $errors->first('editoria') }}</label>
						@endif
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5>Tags</h5>
					<span>Tags para serem usadas neste artigo</span>
				</div>
				<div class="card-block">
					<select id="tag_list" name="tags[]" class="form-control" multiple>
                    </select>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5>Foto</h5>
					<span>Foto destaque do artigo</span>
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
						<img id="blah" align='middle' src="@if(file_exists(public_path("storage/$tv->path/500x500/$tv->photo"))) {{asset("storage/$tv->path/500x500/$tv->photo")}}  @else http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png @endif" alt="your image" title='' class="img-fluid" />
					</div>
				</div>
			</div>
		</div>
	</div>
</form>



<section id="tvAmic">
    {{-- <<tv-amic-component home-route="{{ route('backend.index', [], false) }}" list-route="{{ route('backend.tv-amic.show', ['tv_amic' => 'show'], false) }}"></tv-amic-component> --}}
    <div class="container">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">Título</label>
                        <input type="text" class="form-control" id="title" placeholder="Título" value="{{$tv->title}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="url_video">Url Vídeo</label>
                        <input type="url" class="form-control" id="url_video" placeholder="Url do vídeo" value="{{$tv->url_video}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="iframe">Iframe</label>
                    <input type="text" class="form-control" id="iframe" placeholder="Iframe" value="{{$tv->iframe}}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="provider_name">Nome do provedor</label>
                        <input type="text" class="form-control" id="provider_name" value="{{$tv->provider_name}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="provider_url">Url do provedor</label>
                        <input type="text" class="form-control" id="provider_url" value="{{$tv->provider_url}}">
                    </div>
                    
                    <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                    </>
                </div>
                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
    </div>
</section>

@endsection