<?php
/*
 * Projeto: amic
 * Arquivo: published_at.blade.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 9:30:00 am
 * Last Modified:  11/11/2020 2:34:02 pm
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */


?>
@section('css-include')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

@endsection

@section('js-include')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.21/moment-timezone-with-data-2012-2022.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/pt-br.min.js" integrity="sha512-1IpxmBdyZx3okPiZ14mzw6+pOGa690uDmcdjqvT310Kwv3NRcjvL/aOtoSprEyvkDdAb7ZtM2um6KrLqLOY97w==" crossorigin="anonymous"></script>

<script type="text/javascript" src="http://tbponline.com.br/assets/backend/js/tempusdominus-bootstrap-4.min.js"></script>


<script type="text/javascript">
	$('#published_at').datetimepicker({
		locale: 'pt-br'
	});
</script>
@endsection