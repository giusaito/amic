<?php
/*
 * Projeto: amic
 * Arquivo: services.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 04/12/2020 10:18:17 am
 * Last Modified:  04/12/2020 3:22:20 pm
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */
?>

<section id="services" class="mt-5">
    <div class="row">
        <div class="container">
            <div class="col-12">
                <div class="owl-carousel owl-theme service-carousel">
                    @foreach($services as $service)
                        <div class="item">
                            <a href="{{route('frontend.service.view', ['slug' => $service->slug])}}">
                                <h4 class="text-center">
                                    <img src="{{asset('storage')}}/{{$service->path}}original-{{$service->image}}" class="img-fluid"> 
                                    CONVENIO SAÚDE 1
                                </h4>
                                <h5 class="service-more">+ SAIBA MAIS</h5>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>