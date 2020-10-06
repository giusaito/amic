@extends('Backend.Layouts.layout')
@section('title', 'TV Amic')
@section('content')

<section id="tvAmic">
    <div class="text-right mt-4">
        <a href="{{route('backend.tv-amic.create')}}" class="btn btn-primary right">Adicionar Vídeo</a>
    </div>
    <!-- <tv-amic-component home-route="{{ route('backend.index', [], false) }}" list-route="{{ route('backend.tv-amic.show', ['tv_amic' => 'show'], false) }}"></tv-amic-component>  -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Imagem</th>
                        <th scope="col">Status</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Criado por:</th>
                        <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tvAmic as $tv)
                            <tr>
                                <th scope="row">
                                    <a href="{{$tv->image}}" target="_blank">
                                        <img src="{{$tv->image}}" class="img-fluid" width="80">
                                    </a>
                                </th>
                                @if($tv->status == "PUBLISHED")
                                    <th scope="row"><span class="label label-primary">Publicado</span></th>
                                @else
                                    <th scope="row"><span class="label label-default">Rascunho</span></th>
                                @endif
                                <th scope="row">{{$tv->title}}</th>
                                <th scope="row">{{ Str::limit($tv->description, 50) }}</th>
                                <th scope="row">{{$tv->user->name}}</th>
                                <th scope="row">
                                    <a href="{{route('backend.tv-amic.edit', ['tv_amic' => $tv->id])}}" class="btn btn-white btn-sm">
                                        <i class="fa fa-pencil"></i> 
                                        Editar
                                    </a>
                                    <form  method="POST" action="{{route('backend.tv-amic.destroy', ['tv_amic' => $tv->id])}}" style="display:inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <div class="form-group">
                                            <button onclick="return confirm('Tem certeza que deseja excluir o vídeo {{$tv->title}}?')"  type="submit" class="btn btn-danger text-white">
                                                <i class="fa fa-pencil"></i>
                                                Excluir
                                            </button>
                                        </div>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection