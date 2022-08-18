@extends('admin.master')
@section('title', 'Productos ')
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{url('/admin/product')}}"><i class="fa-solid fa-home"></i>&nbsp;Inmuebles</a>
	</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa-solid fa-home"></i>&nbsp;Inmuebles Registrados</h2>
		</div>
		<div class="inside">
			<table class="table">
				<div class="btns">
					<a class="btn btn-primary" href="{{url('admin/product/add')}}"><i class="fa-solid fa-square-plus"></i>&nbsp;Agregar Inmueble</a>
				</div>
			</table>
		</div>
		<table class="table table-striped mtop16">
			<thead>
				<tr>
					<td>Id</td>
					<td>Imagen</td>
					<td>Nombre</td>
					<td>Categoria</td>
					<td>Precio</td>
					<td>Ubicacion</td>
					<td>Estatus</td>
					<td>Asesor</td>
					<td>Acciones</td>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $p)
				<tr @if($p->status == "0") class="table-danger-custom" @endif>
					<td width="50">{{$p->id}}</td>
					<td width="64"> <a href="{{url('/uploads/'.$p->file_path.'/'.$p->image)}}" data-fancybox="gallery"><img src="{{url('/uploads/'.$p->file_path.'/t_'.$p->image)}}" width="64"></a></td>
					<td>{{$p->name}}</td>
					<td>{{$p->cat->name}}</td>
					<td>{{$p->price}}</td>
					<td></td>
					<td>@if($p->status =="0") Borrador @else Publicada @endif</td>
					
					<td>@if($p->ase->status == '1') {{$p->ase->name}} @else El asesor {{$p->ase->name}} ha sido eliminado<br>
					por favor cambiarlo @endif  </td>
					
					{{-- <td>@if($p->aseDel->deleted_at != null) {{$p->ase->name}} @else sin Asesor @endif</td> --}}
					<td>
						<div class="opts"><a href="{{url('/admin/product/'.$p->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a></div>
						<div class="opts"><a href="{{url('/admin/product/'.$p->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a></div>
					</td>
				</tr>	
				@endforeach
				<tr>
					<td colspan="8">{!! $products->Render() !!}</td>
				</tr>
			</tbody>		
		</table>
	</div>
	
</div>
@endsection