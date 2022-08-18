@extends('admin.master')
@section('title', 'Editar Inmueble')
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{url('/admin/product')}}"><i class="fa-solid fa-home"></i>&nbsp;Inmuebles</a>
	</li>
	<li class="breadcrumb-item">
		<a href="#"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Editar Inmueble</a>
	</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edicion de inmueble</h2>
				</div>
				<div class="inside">
					{!!Form::open(['url'=> '/admin/product/'.$p->id.'/edit', 'files' => true])!!}
					<div class="row">
						<div class="col-md-3">
							<label for="name">Nombre del producto</label>
							<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
							{!!Form::text('name', $p->name,['class' => 'form-control'])!!}
							</div>
						</div>
						<div class="col-md-3">
							<label for="category">Tipo de operacion</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
								{!!Form::select('category', $cats, $p->category_id, ['class' => 'form-select'])!!}
							</div>
						</div>
						<div class="col-md-3">
							<label for="status">Estatus</label>
							<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
							{!!Form::select('status', ['0' => 'Borrador', '1'=> 'Publicado'], $p->status, ['class' => 'form-select'])!!}
							</div>
						</div>
						<div class="col-md-3">
							<label for="name">Imagen Destacada</label>
							<div class="custom-file">
								<div class="elipsis">
							{!!Form::file('img', ['class'=>'custom-file-input','id' => 'customFile', 'accept' => 'image/*'])!!}
								</div>
							<label class="custom-file-label" for="customFile"></label>
							</div>
						</div>
					</div>
					<div class="row mtop16">
						<div class="col-md-3">
							<label for="price">Precio</label>
							<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-money-bill"></i></span>
							{!!Form::number('price', $p->price, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any'])!!}
							</div>
						</div>	
						<div class="col-md-3">
							<label for="indiscount">En descuento</label>
							<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
							{!!Form::select('indiscount', ['0' => 'No', '1'=> 'Si'], $p->in_discount, ['class' => 'form-select'])!!}
							</div>
						</div>	
						<div class="col-md-3">
							<label for="discount">Descuento:</label>
							<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
							{!!Form::number('discount', $p->discount, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any'])!!}
							</div>
						</div>
						<div class="col-md-3">
							<label for="asesor">Asesor</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
								{!!Form::select('asesor', $as, $p->asesor_id, ['class' => 'form-select'])!!}
							</div>
						</div>
					</div>
					<div class="row mtop16">
						<div class="col-md-11">
							<label for="content">Descripcion</label>
							{!!Form::textarea('content', $p->content, ['class' => 'form-control'])!!}
						</div>
					</div>
					<div class="row mtop16">
						<div class="col-md-12">
							<div class="test">
								{!!Form::submit('Guardar', ['class' => 'btn-save'])!!}
							</div>
						</div>
					</div>
					{!!Form::close()!!}	
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 align="center"class="title"><i class="fa-solid fa-image"></i>&nbsp;Imagen destacada</h2>
					<div class="inside" align="center">
						<img style="cursor: pointer;" data-fancybox="gallery" src="{{url('/uploads/'.$p->file_path.'/t_'.$p->image)}}" width="64" >
					</div>
				</div>
			</div>
			<div class="panel shadow mtop16">
				<div class="header">
					<h2 align="center"class="title"><i class="fa-solid fa-photo-film"></i>&nbsp;Imagenes adicionales</h2>
				</div>
				<div class="inside product_gallery">
					{!!Form::open(['url' => '/admin/product/'.$p->id.'/gallery/add', 'files' => true, 'id' => 'form_product_gallery'])!!}
					{!!Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display: none;', 'multiple' => 'multiple', 'required'])!!}
					{!!Form::close()!!}
					<div class="tumb">
						<a id="btn_product_file_image"><i class="fa-solid fa-photo-film"></i></a>
					</div>
					<div class="tumbs">
						@foreach($p->getGallery as $img)
						<div class="tumbs-tumb">
							<a  href="{{url('/admin/product/'.$p->id.'/gallery/'.$img->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
							<img width="110" src="{{url('/uploads/'.$img->file_path).'/t_'.$img->file_name}}">
						</div>
						@endforeach
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>
@endsection