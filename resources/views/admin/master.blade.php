<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token()}}">
	<meta name="routName" content="{{ Route::currentRouteName() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{url('/static/css/admin.css?v='.time()) }}">
	<script src="https://kit.fontawesome.com/e9dc34ceb0.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


	<script src="{{url('/static/js/admin.js?v=.'.time())}}"></script>
	<script >
		/*$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});*/
	</script>
	<title>@yield('title')Shop Inmobiliario</title>
</head>
<body>
	<div class="wrapper">
		<div class="col1">@include('admin.sidebar')</div>
		<div class="col2">
			<nav class="navbar navbar-expand-lg shadow">
				<div class="collpasse navbar-collapse">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="{{url('/admin')}}" class="nav-link"><i class="fas fa-home"></i>Inicio</a>
						</li>
					</ul>
				</div>
			</nav>
			<div class="page">
				<div class="container-fluid">
					<nav aria-label="breadcrumb shadow">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{url('/admin')}}"><i class="fas fa-home"></i>Inicio</a>
							</li>
							@section('breadcrumb')
							@show
						</ol>
					</nav>
				</div>
			@if(Session::has('message'))
			<div class="container">
					<div class="alert alert-{{Session::get('typealert')}}" style=		"display:none;">
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
							setTimeout(function(){$('.alert').slideUp();},10000);
						</script>
					</div>
				</div>
			@endif
			@section('content')
			@show
			</div>
		</div>
	</div>
</body>
</html>