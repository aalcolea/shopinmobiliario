
@extends('emails.master')

@section('content')
Beienvenido <strong>{{$name}}</strong>
<style type="text/css">
	.btn-rec {
		background-color: #80A8B9;
		color: white;
		border-radius: 6px;
		text-align: center;
		height: 40px;

	}
</style>
<p>Ha solcitado la recuperacion de su contrasena.</p>
<p>Por favor haga click eb el siguiente boton para continuar</p>
<p>{{$code}}</p>
<p class="btn-rec"><a style="padding: 12px; color: white; text-decoration: none; display: inline-block;"href="{{url('/reset?email='.$email)}}">Recuperar mi contrasena </a></p>
<hr>
<p>En caso de no funcionar por favor copie y pegue el siguiente enlace en su navegador</p>
<p>{{url('/reset?email='.$email)}}</p>
@stop