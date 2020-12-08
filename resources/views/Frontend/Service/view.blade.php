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
            <div class="col-6 col-lg-3 bg-warning text-white pt-5" style="min-height:400px">
                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_1}}" class="mx-auto d-block img-fluid" width="80">
                <h4 class="text-center text-white mt-4">{{$record->benefit_desc_1}}</h4>
            </div>
            <div class="col-6 col-lg-3 bg-danger text-white pt-5">
                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_2}}" class="mx-auto d-block img-fluid" width="80">
                <h4 class="text-center text-white mt-4">{{$record->benefit_desc_2}}</h4>
            </div>
            <div class="col-6 col-lg-3 bg-warning text-white pt-5">
                <img src="{{asset('storage')}}/{{$record->path}}original-{{$record->benefit_icon_3}}" class="mx-auto d-block img-fluid" width="80">
                <h4 class="text-center text-white mt-4">{{$record->benefit_desc_3}}</h4>
            </div>
            <div class="col-6 col-lg-3 bg-danger text-white pt-5">
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

@include('Frontend.Layout.Includes.footer')
@endsection


<style>
#internal-service-head {
    width:100%;
    min-height:200px;
    background-color: orange;
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
    position: absolute;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    margin-top:-40px;
    z-index: 1;
}
</style>