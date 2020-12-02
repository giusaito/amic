<?php
/*
 * Projeto: amic
 * Arquivo: photos.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 01/12/2020 5:45:00 pm
 * Last Modified:  01/12/2020 5:45:46 pm
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


?>
<div class="fotorama mt-5" data-nav="thumbs" data-allowfullscreen="true" data-keyboard="true" >
    @foreach($article->photos as $photo)
    <a href="{{asset('storage')}}/{{$photo->path}}1200x600-{{$photo->image}}">
        <img src="{{asset('storage')}}/{{$photo->path}}150x150-{{$photo->image}}">
    </a>
    @endforeach
</div>

@section('css')
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
@endsection
@section('js')
<!-- Fotorama from CDNJS, 19 KB -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
@endsection