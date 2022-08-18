<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@extends('admin.master')
@section('title', 'Usuarios ')
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{url('/admin/users')}}"><i class="fa-solid fa-map-pin"></i>&nbsp;Usuarios</a>
	</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa-solid fa-users"></i> Usuarios</h2>
		</div>
		<div class="inside">
			<div class="row">
				<div class="cold-md-2 offset-md-10">
					<div class="dropdown">
  						<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">  						  <i class="fa-solid fa-magnifying-glass"></i> Busqueda
  						</button>
  						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    						<a style="color: black;" class="dropdown-item" href="{{url('/admin/users/all')}}"><i class="fa-solid fa-list"></i> Todos</a>
    						<a style="color: black;" class="dropdown-item" href="{{url('/admin/users/0')}}"><i class="fa-solid fa-user-check"></i> Verificados</a>
    						<a style="color: black;" class="dropdown-item" href="{{url('/admin/users/1')}}"><i class="fa-solid fa-circle-xmark"></i> No verificados</a>
    						<a style="color: black;" class="dropdown-item" href="{{url('/admin/users/100')}}"><i class="fa-solid fa-ban"></i> Suspendidos</a>
  						</div>
					</div>
				</div>
				</div>
			</div>
			<table class="table mtop16">
				<thead>
					<tr>
						<td>Id</td>
						<td>Nombre</td>
						<td>Apellido</td>
						<td>Correo</td>
						<td>Estatus</td>
						<td>Permisos</td>
						<td>Ubicacion</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td> {{$user->lastname}}</td>
						<td>{{$user->email}}</td>
						<td>{{getStatusUserArray(null, $user->status)}}</td>
						<td>{{getRolUserArray(null, $user->role)}}</td>
						<td>@if($user->location == '1') Yucatan @elseif($user->location == '2') Campeche @else Quintana Roo @endif</td>
						<td> <div class="opts"><a href="{{url('/admin/users/'.$user->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></div></a>
							<div class="opts"><a href="{{url('/admin/users/'.$user->id.'/permissons')}}" data-toggle="tooltip" data-placement="top" title="Permisos"><i class="fa-solid fa-gear"></i></div></a>
							<div class="opts"><a href="{{url('/admin/users/'.$user->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a></div></td>
					</tr>
					@endforeach
					<tr><nav aria-label="...">
						<ul class="pagination">
						<td colspan="6"> {!! $users->render() !!} as</td></ul></nav>	
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
@endsection