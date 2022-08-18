@extends('admin.master')
@section('title', 'Editar usuario')
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{url('/admin/users')}}"><i class="fa-solid fa-map-pin"></i>&nbsp;Usuarios</a>
	</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="page_user">
		<div class="row">
			<div class="col-md-4">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;Informacion de Usuario </h2>
					</div>
					<div class="inside">
						<div class="row">
							<div class="col-md-3">
								<div class="mini_profile">
									@if(is_null($u->avatar))
										<img class="avatar" src="{{url('/static/images/default.jpg')}}">
									@else
										<img class="avatar" src="{{url('/uploads/users/'.$u->id.'/'.$u->avatar)}}">
									@endif
								</div>
							</div>
							<div class="col-md-9">
								<div class="info">
									<span class="title"><i class="fa-solid fa-signature"></i> Nombre:</span><br>
									<span class="text">&nbsp;&nbsp; {{$u->name}} {{$u->lastname}}</span><br>
									<span class="title"><i class="fa-solid fa-mobile-screen"></i> Numero:</span><br>
									<span class="text">&nbsp;&nbsp; {{$u->number}}</span><br>
									<span class="title"><i class="fa-solid fa-envelope"></i> Correo:</span><br>
									<span class="text">&nbsp;&nbsp; {{$u->email}}</span><br>
									<span class="title"><i class="fa-solid fa-house-chimney-crack"></i> Ubiacion:</span><br>
									<span class="text">&nbsp;&nbsp; @if($u->location == '1') Yucatan @elseif($u->location == '2') Campeche @else Quintana Roo @endif</span><br>
									<span class="title"><i class="fa-solid fa-calendar-days"></i> Fecha de registro:</span><br>
									<span class="text">&nbsp;&nbsp; {{$u->created_at}}</span><br>
									<span class="title"><i class="fa-solid fa-people-roof"></i> Tipo de usuario:</span><br>
									<span class="text">&nbsp;&nbsp; {{getRolUserArray(null, $u->role)}}</span>
								</div><hr>
								@if($u->status=="100")
									<a href="{{url('/admin/users/'.$u->id.'/banned')}}" class="btn btn-success">Reactivar cuenta</a>
								@else
									<a href="{{url('/admin/users/'.$u->id.'/banned')}}" class="btn btn-danger">Suspender cuenta</a>
								@endif
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fa-solid fa-magnifying-glass-arrow-right"></i>&nbsp;Editar Usuario</h2>
					</div>
					<div class="inside">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection