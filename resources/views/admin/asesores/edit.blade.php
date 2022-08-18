@extends('admin.master')
@section('title', 'Asesores ')
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{url('/admin/categories')}}"><i class="fa-solid fa-people-roof"></i>&nbsp;Equipo</a>
	</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa-solid fa-person-circle-plus"></i>&nbsp;Editando Asesor: {{$as->name}}</h2>
				</div>
				<div class="inside">
					{!!Form::open(['url' => '/admin/asesores/'.$as->id.'/edit', 'files' => true])!!}
						<label for="name">Nombre Completo:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
							{!!Form::text('name', $as->name,['class' => 'form-control'])!!}
						</div>
						<label for="email" class="mtop16">Correo Electronico</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope-open"></i></span>
						{!!Form::email('email', $as->email, ['class' => 'form-control', 'required'])!!}
						</div>
						<label for="number" class="mtop16">Numero telefonico</label>
						<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-mobile-screen"></i></span>
						
						{!!Form::number('number', $as->number, ['class' => 'form-control', 'required'])!!}
						</div>
						{{-- <label for="module"class="mtop16">Modulo:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
							{!!Form::select('module',['0' => 'si', '1' => 'no'], 0, ['class' => 'form-select'])!!}
						</div> --}}
						<label for="name">Foto de Perfil</label>
						<div class="custom-file">
						{!!Form::file('img', ['class'=>'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*'])!!}
						<label class="custom-file-label" for="customFile"></label>
						</div>
						{!!Form::submit('Guardar', ['class' => 'btn btn-success mtop16'])!!}
					{!!Form::close()!!}
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 align="center"class="title"><i class="fa-solid fa-image"></i>&nbsp;Foto de perfil</h2>
					<div class="inside" align="center">
						<img style="cursor: pointer;" data-fancybox="gallery" src="{{url('/uploads/'.$as->file_path.'/t_'.$as->image)}}" width="64" >
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection