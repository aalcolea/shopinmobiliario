<div class="col-md-6">
	<div class="panel shadow">
		<div class="row">
			<div class="col-md-6">
				<div class="header">
					<h2 class="title"><i class="fa-solid fa-industry"></i>&nbsp;Estadisticas</h2>
				</div>
				<div class="inside">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="dashboard" value="true" @if(kvfj($u->permissons, 'dashboard')) checked @endif><label for="dashboard">Visualizar </label>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="header">
					<h2 class="title"><i class="fa-solid fa-calendar-check"></i>&nbsp;Categorias</h2>
				</div>
				<div class="inside">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="categories" value="true" @if(kvfj($u->permissons, 'categories')) checked @endif><label for="categories">Visualizar </label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">	
			<div class="col-md-6">
				<div class="header">
					<h2 class="title"><i class="fa-solid fa-house"></i>&nbsp;Productos</h2>
				</div>
				<div class="inside">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="products" value="true" @if(kvfj($u->permissons, 'products')) checked @endif><label for="products">Visualizar </label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="product_add" value="true" @if(kvfj($u->permissons, 'product_add')) checked @endif><label for="products">Agregar </label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="product_edit" value="true" @if(kvfj($u->permissons, 'product_edit')) checked @endif><label for="products">Editar </label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="product_delete" value="true" @if(kvfj($u->permissons, 'product_delete')) checked @endif><label for="products">Eliminar </label>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="header">
					<h2 class="title"><i class="fa-solid fa-users"></i>&nbsp;Usuarios</h2>
				</div>
				<div class="inside">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="user_list" value="true" @if(kvfj($u->permissons, 'user_list')) checked @endif><label for="user_list">Visualizar </label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="user_banned" value="true" @if(kvfj($u->permissons, 'user_banned')) checked @endif><label for="user_list">Suspender </label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="user_edit" value="true" @if(kvfj($u->permissons, 'user_edit')) checked @endif><label for="user_list">Editar </label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="user_delete" value="true" @if(kvfj($u->permissons, 'user_delete')) checked @endif><label for="user_delete">Eliminar </label>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>