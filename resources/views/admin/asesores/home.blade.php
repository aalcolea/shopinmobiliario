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
					<h2 class="title"><i class="fa-solid fa-person-circle-plus"></i>&nbsp;Anadir Asesor al Sistema</h2>
				</div>
				<div class="inside">
					{!!Form::open(['url' => '/admin/asesores/add', 'files' => true])!!}
						<label for="name">Nombre Completo:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
							{!!Form::text('name', null,['class' => 'form-control'])!!}
						</div>
						<label for="email" class="mtop16">Correo Electronico</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope-open"></i></span>
						{!!Form::email('email', null, ['class' => 'form-control', 'required'])!!}
						</div>
						<label for="number" class="mtop16">Numero telefonico</label>
						<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-mobile-screen"></i></span>
						
						{!!Form::number('number', null, ['class' => 'form-control', 'required'])!!}
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
		<div class="col-md-7">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa-solid fa-people-robbery"></i>&nbsp;Asesores</h2>
				</div>
				<div class="inside">
					{{-- <nav class="nav nav-pills nav-fill">
						
						<div class="navlink">
						<a class="nav-link" href=""><i class="fa-solid fa-list"></i>&nbsp;</a></div>
						
					</nav> --}}
					<table class="table mtop16">
						<thead>
							<tr>
								<td width="32">Imagen de Perfil</td>
								<td>Nombre </td>
								<td width="140">Numero</td>
								<td width="140">Correo</td>
							</tr>
						</thead>
						<tbody>
							@foreach($as as $ase)
							<tr>
								<td><a href="{{url('/uploads/'.$ase->file_path.'/'.$ase->image)}}" data-fancybox="gallery"><img src="{{url('/uploads/'.$ase->file_path.'/t_'.$ase->image)}}" width="64"></a></td>
								<td>{{$ase->name}}</td>
								<td> {{$ase->number}}</td>
								<td>{{$ase->email}}</td>
								<td>
									<div class="opts"><a href="{{url('/admin/asesores/'.$ase->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a></div>
									<div class="opts"><a href="{{url('/admin/asesores/'.$ase->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a></div>	
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection