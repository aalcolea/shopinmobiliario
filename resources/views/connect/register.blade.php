@extends('connect.master')
@section('title', 'Registrarse')

@section('content')
<div class="box box-register shadow">
	<div class="headerR">
		<a href="{{url('/')}}">
			<img src="{{ url('/static/images/logo.png')}}">
		</a>
	</div>
	<div class="inside">
	{!! Form::open(['url' => '/register']) !!}

	<label for="name">Nombre</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-pencil"></i></div>
		</div>
	{!!Form::text('name', null, ['class' => 'form-control', 'required'])!!}
	</div>
		<label for="lastname">Apellido</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-pencil"></i></div>
		</div>
	{!!Form::text('lastname', null, ['class' => 'form-control', 'required'])!!}
	</div>
	<label for="email" class="mtop16">Correo Electronico</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-envelope-open"></i></div>
		</div>
	{!!Form::email('email', null, ['class' => 'form-control', 'required'])!!}
	</div>
	<label for="number" class="mtop16">Numero telefonico</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-mobile-screen"></i></div>
		</div>
	{!!Form::number('number', null, ['class' => 'form-control', 'required'])!!}
	</div>
	<label for="location" class="mtop16">Ubicacion</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-location-dot"></i></i></div>
		</div>
	{!!Form::select('location', ['1' => 'Yucatan', '2'=> 'Campeche', '3' => 'Quintana Roo'], 1, ['class' => 'form-control', 'required'])!!}
	</div>
	<label for="password" class="mtop16">Contrasena</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
		</div>
	{!!Form::password('password', ['class' => 'form-control', 'required', 'style' => 'outline: none; shadow: none;'])!!}
	</div>
	<label for="password" class="mtop16">Confirmar contrasena</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
		</div>
	{!!Form::password('cpassword', ['class' => 'form-control', 'required', 'style' => 'outline: none; shadow: none;'])!!}
	</div>
	{!!Form::submit('Registrarse', ['class' => 'btn btn-primary mtop16 '])!!}
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
					setTimeout(function(){ $('.alert').slideUp(); }, 10000);
				</script>
			</div>
		</div>
	@endif
	<div class="mtop16">
		<a href="{{url('/login')}}">Iniciar sesion</a>
	</div>
	</div>
 </div>
	
@stop