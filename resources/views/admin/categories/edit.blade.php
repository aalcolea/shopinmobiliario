@extends('admin.master')
@section('title', 'Ubicaciones ')
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{url('/admin/categories')}}"><i class="fa-solid fa-home"></i>&nbsp;Categorias</a>
	</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa-solid fa-home"></i>&nbsp;Editar Seccion</h2>
				</div>
				<div class="inside">
					{!!Form::open(['url' => '/admin/categories/'.$cat->id.'/edit'])!!}
						<label for="name">Nombre:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
							{!!Form::text('name', $cat->name,['class' => 'form-control'])!!}
						</div>
						<label for="module"class="mtop16">Modulo:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
							{!!Form::select('module', getModulesArray(), $cat->module, ['class' => 'form-select'])!!}
						</div>
						<label for="icon" class="mtop16">Portada:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
							{!!Form::text('icon', $cat->icono,['class' => 'form-control'])!!}
						</div>
						{!!Form::submit('Guardar', ['class' => 'btn btn-success mtop16'])!!}
					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection