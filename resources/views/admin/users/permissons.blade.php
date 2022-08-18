@extends('admin.master')
@section('title', 'Editar Permisos usuario')
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{url('/admin/users')}}"><i class="fa-solid fa-map-pin"></i>&nbsp;Usuarios</a>
	</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="page_user">
		<div class="row">
			<div class="header">
				<h2 class="title"><i class="fa-solid fa-gear"></i>&nbsp;Permisos del Usuario: {{$u->name}} {{$u->lastname}}</h2>
			</div>
			<form action="{{url('/admin/users/'.$u->id.'/permissons')}}" method="POST">
				@csrf
				<div class="row">
				@include('admin.users.permissons.module'){{-- 
				@include('admin.users.permissons.cats')
				@include('admin.users.permissons.products') --}}
				</div>
				<div class="row mtop16">{{-- 
					@include('admin.users.permissons.users')
 --}}				</div>
				<div class="row  mtop16">
					<div class="col-md-12">
						<div class="panel shadow">
							<div class="inside">
							<input type="submit" value="Guardar" class="btn btn-primary">	
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection