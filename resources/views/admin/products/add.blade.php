@extends('admin.master')
@section('title', 'Agregar Inmueble')
@section('breadcrumb')
	<li class="breadcrumb-item">
		<a href="{{url('/admin/users')}}"><i class="fa-solid fa-home"></i>&nbsp;Inmuebles</a>
	</li>
	<li class="breadcrumb-item">
		<a href="{{url('/admin/users')}}"><i class="fa-solid fa-home"></i>&nbsp;Agregar Inmueble</a>
	</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa-solid fa-home"></i>&nbsp;</h2>
		</div>
		<div class="inside">
			{!!Form::open(['url'=> '/admin/product/add', 'files' => true])!!}
			<div class="row">
				<div class="col-md-6">
					<label for="name">Nombre del producto</label>
					<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
					{!!Form::text('name', null,['class' => 'form-control'])!!}
					</div>
				</div>
				<div class="col-md-3">
					<label for="category">Tipo de operacion</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
						{!!Form::select('category', $cats, 0, ['class' => 'form-select'])!!}
					</div>
				</div>
				<div class="col-md-3">
					<label for="name">Imagen Destacada</label>
					<div class="custom-file">
					{!!Form::file('img', ['class'=>'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*'])!!}
					<label class="custom-file-label" for="customFile"></label>
					</div>
				</div>
			</div>
			<div class="row mtop16">
				<div class="col-md-3">
					<label for="price">Precio</label>
					<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-money-bill"></i></span>
					{!!Form::number('price', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any'])!!}
					</div>
				</div>	
				<div class="col-md-3">
					<label for="indiscount">En descuento</label>
					<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
					{!!Form::select('indiscount', ['0' => 'No', '1'=> 'Si'], 0, ['class' => 'form-select'])!!}
					</div>
				</div>	
				<div class="col-md-3">
					<label for="discount">Descuento:</label>
					<div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
					{!!Form::number('discount', 0.00, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any'])!!}
					</div>
				</div>
				<div class="col-md-3">
					<label for="asesor">Asesor</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
						{!!Form::select('asesor', $as, ['class' => 'form-select'])!!}
					</div>
				</div>
			</div>
			<div class="row mtop16">
				   <h3 align="center">Ubicacion</h3>
				   <div class="col-md-4">
				   <div class="form-group">
				    <select name="estado" id="estado" class="form-control input-lg dynamic" data-dependent="ciudad">
				     <option value="">Estado</option>
					     @foreach($location as $estado)
					     <option value="{{$estado->estado}}"> {{$estado->estado}}</option>
					     @endforeach 
				    </select>
				   </div>
				   {{-- {!!Form::select('indiscount', $estado	, ['class' => 'form-select'])!!} --}}
				   </div>
				   <div class="col-md-4">
				   <div class="form-group">
				    <select name="ciudad" id="ciudad" class="form-control input-lg dynamic" data-dependent="comisaria">
				     <option  value="">Municipio</option>
				    </select>
				   </div>
				   </div>
				   <div class="col-md-4">
				   <div class="form-group">
				    <select name="comisaria" id="comisaria" class="form-control input-lg">
				     <option value="">Comisaria</option>
				    </select>
				   </div>
				</div>  
			</div>
			{{ csrf_field()}}
			<div class="row mtop16">
				<div class="col-md-11">
					<label for="content">Descripcion</label>
					{!!Form::textarea('content', null, ['class' => 'form-control'])!!}
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
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script >
	$(document).ready(function(){
		$('.dynamic').change(function(){
			if($(this).val() != ''){
				let select = $(this).attr('id');
				let value = $(this).val();
				let dependent = $(this).data('dependent');
				let _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{route('product.fetch')}}",
					method: "POST",
					data:{select:select, value:value, _token:_token, dependent:dependent},
					success:function(result){
						$('#'+dependent).html(result);
					}
				})
			}
		});
		$('#estado').change(function(){
			$('#ciudad').val('');
			$('#comisaria').val('');
		});
		$('#ciudad').change(function(){
			$('#comisaria').val('');
		});
	});
</script>