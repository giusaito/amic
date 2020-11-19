@extends('Backend.Layouts.layout')
@section('title', 'Adicionar Equipe')
@section('content')

<form action="{{ route('backend.equipe.store') }}" class="form-bordered" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.equipe.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="name">Nome</label>
					<input name="name" type="text" class="form-control" id="name" placeholder="Nome completo" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" class="form-control" id="description" placeholder="Descrição curta" required="required">
				</div>
				<div class="form-group">
					<label for="office">Cargo</label>
					<input name="office" type="text" class="form-control" id="office" placeholder="Cargo ex: Supervisor" required="required">
				</div>
				<div class="form-group">
					<label for="email">E-mail</label>
					<input name="email" type="email" class="form-control" id="email" placeholder="E-mail" required="required">
				</div>
				<div class="form-group">
					<label for="whatsapp">Whatsapp</label>
					<input name="whatsapp" type="tel" class="form-control" id="whatsapp" placeholder="Whats" required="required">
				</div>
			</div>
		</div>
		
		<div class="col-md-3 mt-3">
			<button type="submit" id="submit-all" class="btn btn-primary">
				<i class="fa fa-check"></i>
					Adicionar
			</button>
			<div class="card mt-3 mb-3">
				<div class="card-header">
						<h5>Diretor</h5>
						<span>Escolha se o colaborador faz parte da diretoria</span>
					</div>
					<div class="card-block p-3">
						<select name="director" id="director" class="form-control" required="required">
							<option value="NAO">Não</option>
							<option value="SIM">Sim</option>
						</select>
						@if($errors->first('status'))
							<label for="status" class="error">{{ $errors->first('status') }}</label>
						@endif
					</div>
				</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Foto</h5>
					<span>Defina a foto</span>
				</div>
					<div class="card-block p-3">
						<input type="file" name="feature_image" class="dropify" data-allowed-file-extensions="jpeg jpg png"  data-max-file-size="1M" required="required"/>
					</div>
			</div>
		</div>
	</div>
</form>
</section>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>


<script>
$('.dropify').attr("data-default-file");
	$('.dropify').dropify({
		messages: {
			default: 'Arraste e solte um arquivo aqui ou clique',
			replace: 'Arraste e solte um arquivo ou clique para substituir',
			remove:  'remover',
			fileSize:   'Desculpe, o arquivo é muito grande'
		}
	});
	var drEvent = $('#photoArtigo').dropify();
	drEvent.on('dropify.beforeClear', function(event, element){
		return confirm("Você tem certeza que deseja excluir a foto?");
	});
</script>

@endsection

@include('Backend.Includes.published_at')