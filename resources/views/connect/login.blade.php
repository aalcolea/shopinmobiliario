@extends('connect.master')
@section('title', 'Iniciar Sesion')

@section('content')
<div class="box box-login shadow">
	<div class="header">
		<a href="{{url('/')}}">
			<img src="{{ url('/static/images/logo.png')}}">
		</a>
	</div>
	<div class="inside">
	{!! Form::open(['url' => '/login']) !!}
	<label for="email">Correo Electronico</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-envelope-open"></i></div>
		</div>
	{!!Form::email('email', null, ['class' => 'form-control'])!!}
	</div>
	<label for="password" class="mtop16">Contrasena</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
		</div>
	{!!Form::password('password', ['class' => 'form-control', 'style' => 'outline: none; shadow: none;'])!!}
	</div>
	{!!Form::submit('Ingresar', ['class' => 'btn btn-primary mtop16 '])!!}
	{!! Form::close() !!}
	@if(Session::has('message'))
	<div class="container">
			<div class="alert alert-{{Session::get('typealert')}}" style="display:none;">
				{{Session::get('message')}}
				@if ($errors->any())
				<ul>
					@foreach($errors->all() as $error)
					<li> {{ $error }} </li>
					@endforeach
				</ul>
				@endif
				<script >
					$('.alert').slideDown();
					setTimeout(function(){$('.alert').slideUp();},10000);
				</script>
			</div>
		</div>
	@endif
	<div class="mtop16">
		<a href="{{url('/register')}}">Registrarse</a>&nbsp;
		<a href="{{url('/recover')}}">Contrasena olvidada</a>
	</div>
	</div>
 </div>
	
@stop