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
		</div>
	</div>
</section>

<section id="internal-service-content" class="pb-5">
   <div class="container">
		<div class="row">
			<div class="col-md-12">
                <h2 class="text-center vantage">Vantagens<h2>
            </div>
            <div class="col-3 bg-primary text-white">
            </div>
            <div class="col-3 bg-dark text-white" style="height:100%">
                ssss
                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_1}}" class="img-fluid d-none d-lg-block service-img">

            </div>
            <div class="col-3 bg-dark text-white">
                wwwww
            </div>
            <div class="col-3 bg-success text-white">
                wwwww
            </div>
		</div>
	</div>
</section>
@include('Frontend.Layout.Includes.footer')
@endsection


<style>
#internal-service-head {
    width:100%;
    min-height:200px;
    background-color: orange;
}

.service-img {
    position: absolute;
    margin-top: 50px;
}

.service-content {
    font-size: 27px;
    line-height: 41px;
}

.vantage {
        background: #000;
    color: #fff;
    width: 300px;
    border-radius: 30px;
    padding: 10px;
    text-align: center;
    display: block;
    margin: 0 auto;
}
</style>