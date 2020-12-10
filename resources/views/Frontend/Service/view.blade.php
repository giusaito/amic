@extends('Frontend.Layout.amic')
@section('title', $record->title)
@section('content')
@include('Frontend.Layout.Includes.header')

<section id="internal-service-head" class="mb-5">
   <div class="container">
        <div class="row">
            <div class="col-8 mt-5">
                <hgroup>
                    <h1>{{$record->title}}</h1>
                    <h6>{{$record->description}}</h6>
                </hgroup>
            </div>
            <div class="col-4">
                <img src="{{asset('storage')}}/{{$record->path_internal}}original-{{$record->image_internal}}" class="img-fluid d-none d-lg-block service-img">
            </div>
        </div>
   </div>
</section>

<section id="internal-service-content" class="pb-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 service-content">
                {!! $record->content !!}
            </div>
            <div class="col-xs-12 col-lg-4 mt-5">
                @include('Frontend.Article.Themes.Includes.ads')
                <div id="news-related" class="mt-5">
                    <h3><strong><span>|</span> Notícias</strong></h3>
                     <div class="row">
                         @foreach($articles as $article)
                            <div class="col-4">
                                <a href="{{route('frontend.article.view', ['id' => $article->id, 'slug' => $article->slug])}}">
                                    <img src="{{asset('storage')}}/{{$article->path}}150x150-{{$article->image}}" class="img-fluid">
                                </a>
                            </div>
                            <div class="col-8 mt-4">
                                <a href="{{route('frontend.article.view', ['id' => $article->id, 'slug' => $article->slug])}}">
                                    <p><strong>{{$article->title}}</strong></p>
                                    @if(isset($article->editorias[0]))
                                        <small>{{$article->editorias[0]->title}}
                                    @endif
                                        <i class="far fa-calendar-alt"></i>
                                        {{date('d/m/Y', strtotime($article->published_at))}}
                                        às
                                        <i class="far fa-clock"></i>
                                        {{date('H:m', strtotime($article->published_at))}}
                                </small>
                              </a>
                            </div>
                        @endforeach
                   </div>
                </div>
            </div>
		</div>
	</div>
</section>

<section id="internal-service-vantage" class="pb-5">
   <div class="container">
		<div class="row">
			<div class="col-md-12">
                <h2 class="text-center vantage">Vantagens<h2>
            </div>
            <div class="col-6 col-lg-3 bg-1 text-white pt-5" style="min-height:400px">
                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_1}}" class="mx-auto d-block img-fluid" width="80">
                <h4 class="text-center text-white mt-4">{{$record->benefit_desc_1}}</h4>
            </div>
            <div class="col-6 col-lg-3 bg-2 text-white pt-5">
                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_2}}" class="mx-auto d-block img-fluid" width="80">
                <h4 class="text-center text-white mt-4">{{$record->benefit_desc_2}}</h4>
            </div>
            <div class="col-6 col-lg-3 bg-1 text-white pt-5">
                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_3}}" class="mx-auto d-block img-fluid" width="80">
                <h4 class="text-center text-white mt-4">{{$record->benefit_desc_3}}</h4>
            </div>
            <div class="col-6 col-lg-3 bg-2 text-white pt-5">
                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_4}}" class="mx-auto d-block img-fluid" width="80">
                <h4 class="text-center text-white mt-4">{{$record->benefit_desc_4}}</h4>
            </div>
		</div>
	</div>
</section>

<section id="afer-content-service">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $record->after_content !!}
            </div>
        </div>
    </div>
</section>

<section id="budget-service" class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 offset-xl-3 col-xl-3">
                <h1>
                    Receba um orçamento agora mesmo!
                </h1>
            </div>
            <div class="col-12 col-xl-6">
               <form action="/action_page.php">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Empresa" id="empresa">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="CNPJ" id="cnpj">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" placeholder="E-mail" id="email">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Telefone" id="phone">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" cols="4" rows="4"></textarea>
                  </div>
                  <button type="submit" class="btn btn-lg btn-amic">ENVIAR</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section id="internal-service-agreed" class="pt-5">
   <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center agreed">SEJA UM CONVÊNIADO<h2>
            </div>
            <div class="col-12 offset-xl-3 col-xl-3">
                <h1>
                    {{$record->desc_form_contact}}
                </h1>
            </div>
            <div class="col-12 col-xl-6">
               <form action="/action_page.php">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Empresa" id="empresa">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="CNPJ" id="cnpj">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" placeholder="E-mail" id="email">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Telefone" id="phone">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" cols="4" rows="4"></textarea>
                  </div>
                  <button type="submit" class="btn btn-lg btn-amic">ENVIAR</button>
                </form>
            </div>
        </div>
    </div>
</section>

@include('Frontend.Article.Themes.Includes.services')
@include('Frontend.Layout.Includes.footer')
@endsection

@section('css')

<style>
#internal-service-head {
    width:100%;
    min-height:200px;
    background-color: #f0825f;
}

#internal-service-head h1, #internal-service-head h6 {
    color:#fff;
}

.service-content {
    font-size: 27px;
    line-height: 41px;
}

.vantage {
    background: #695d61;
    color: #fff;
    width: 300px;
    border-radius: 30px;
    padding: 10px;
    position: absolute;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    margin-top:-40px;
    z-index: 1;
}
.bg-1 {
    background-color: #f0825f;
}
.bg-2 {
    background-color: #d49784;
}

#budget-service{
    background-color: #d49784;
    width: 100%;
    padding-bottom: 40px;
}

#budget-service h1 {
    font-size: 3em;
    font-weight: bold;
    color: #fff;
    margin-top: 10%;
}

#internal-service-agreed {
    background: #eef1f6;
    margin-top: 100px;
}

.agreed {
    background: #f0825f;
    color: #fff;
    width: 400px;
    min-height: 50px;
    border-radius: 30px;
    padding: 10px;
    position: absolute;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    margin-top:-90px;
    z-index: 1;
}

.service-img {
    position: absolute;
    width: 100%;
    margin-top: 12%;
}

@media(min-width: 300px) and (max-width:1200px){
    #budget-service h1 {
        margin: -3% 0% 5% 0%;
    }
}

</style>
@endsection