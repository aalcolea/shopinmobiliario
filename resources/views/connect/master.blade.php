<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>THR-@yield('title')</title> <!-- yield es para sobreescribir componentes -->
	<link rel="stylesheet" type="text/css" href="{{ url('/static/css/connect.css?v='.time()) }}">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/e9dc34ceb0.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	
	@section('content')
	Bienvenido
	@show
</body>
</html>