@extends('Backend.Layouts.layout')
@section('title', 'Editar - ' . $event->title)
@section('content')

<form action="{{ route('backend.evento.update', ['evento' => $event->id]) }}" id="article-form" class=" form-bordered" method="post" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col-md-9 mt-3">
			<a class="btn btn-warning" href="{{route('backend.evento.index')}}">	<i class="fa fa-arrow-left"></i> 
					VOLTAR
			</a>
			<div class="card mt-3" style="padding:15px;">
				<div class="form-group">
					<label for="title">Título</label>
					<input name="title" type="text" value="{{$event->title}}" class="form-control" id="title" placeholder="Título do evento" required="required">
				</div>
				<div class="form-group">
					<label for="description">Descrição</label>
					<input name="description" type="text" value="{{$event->description}}" class="form-control" id="description" placeholder="Descrição curta do evento" required="required">
				</div>
				<div class="form-group">
					<label for="city_state">Cidade e Estado</label>
					<input name="city_state" type="text" value="{{$event->city_state}}" class="form-control" id="city_state" placeholder="Ex: Cascavel - PR" required="required">
				</div>
				<div class="form-group">
					<label for="address">Endereço</label>
					<input name="address" type="text" value="{{$event->address}}" class="form-control" id="address" placeholder="Ex: Rua das oliveiras 340 - Centro" required="required">
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
					<h5>Data de início</h5>
					<span>Defina a data de início do evento</span>
				</div>
					<div class="card-block p-3">
						<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="start_date"value="{{date("d/m/Y H:i", strtotime($event->start_date))}}" data-target="#datetimepicker1">
							<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
	                	</div>
					</div>
			</div>
			<div class="card mt-3 mb-3">
				<div class="card-header">
					<h5>Data final</h5>
					<span>Defina a data final do evento</span>
				</div>
					<div class="card-block p-3">
						<div class="input-group date" id="datetimepicker2" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="finish_date" value="{{date("d/m/Y H:i", strtotime($event->finish_date))}}" data-target="#datetimepicker2">
							<div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
	                	</div>
					</div>
				</div>
		</div>
	</div>
</form>
</form>
</section>
@endsection

@include('Backend.Includes.published_at')