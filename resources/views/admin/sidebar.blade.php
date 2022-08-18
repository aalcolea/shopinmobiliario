<div class="sidebar shadow">
	<div class="section-top">
		<div class="logo">
			<img src="{{url('static/images/logo.png')}}">
		</div>
		<div class="user">
			<span class="subtitle">Bienvenido</span>
			<div class="name">
				{{Auth::user()->name}} {{ Auth::user()->lastname}}
				<a href="{{url('/logout')}}" data-toggle="tooltip" data-placement="top" title="Salir"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
			</div>
			<div class="email">
				{{Auth::user()->email}}
			</div>
		</div>
	</div>
	<div class="main">
		<ul>
			<li><a href="{{url('/admin')}}" class="lk-dashboard"><i class="fa-solid fa-industry"></i>
				</i>Estadisticas</a></li>
				<li><a href="{{url('/admin/product')}}" class="lk-products lk-product_add lk-product_edit"><i class="fa-solid fa-house"></i>
				</i>Productos</a></li>
				<li><a href="{{url('/admin/users/all')}}" class="lk-user_list lk-user_edit"><i class="fa-solid fa-users"></i>
				</i>Usuarios</a></li>
				<li><a href="{{url('/admin/categories/0')}}" class="lk-categories"><i class="fa-solid fa-calendar-check"></i>
				</i>Categorias</a></li>
				<li><a href="{{url('/admin/asesores')}}" class="lk-asesores"><i class="fa-solid fa-people-roof"></i>
				</i>Equipo</a></li>
		</ul>
	</div>
</div>