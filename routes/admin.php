<?php 

Route::prefix('/admin')->group(function(){
	Route::get('/', 'Admin\DashboardController@getDashboard')->name('dashboard');//va al dashboard
	//test
	Route::get('/test', 'Admin\DashboardController@getTest')->name('test');
	Route::post('/test', 'Admin\DashboardController@fetch')->name('dashboardcontroller.fetch');
	//users
	Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('user_list');//optiene usuarios
	Route::get('/users/{id}/edit', 'Admin\UserController@getUserEdit')->name('user_edit');
	Route::get('/users/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');
	Route::get('/users/{id}/permissons', 'Admin\UserController@getUserPermissons')->name('user_permissons');
	Route::Post('/users/{id}/permissons', 'Admin\UserController@postUserPermissons')->name('module');
	//products
	Route::get('/product', 'Admin\ProductController@getHome')->name('products');//manda al inicio del producto
	Route::get('/product/add', 'Admin\ProductController@getProductAdd')->name('product_add');//recibe los productos en tabla
	Route::get('/product/{id}/edit', 'Admin\ProductController@getProductEdit')->name('product_edit'); 
	Route::post('/product/{id}/edit', 'Admin\ProductController@postProductEdit')->name('product_edit');
	Route::post('/product/{id}/gallery/add', 'Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');
	Route::get('/product/{id}/gallery/{gid}/delete', 'Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');
	Route::post('/product/add', 'Admin\ProductController@postProductAdd')->name('product_add');
	Route::post('/product/fetch', 'Admin\ProductController@fetch')->name('product.fetch');
	//catgories
	Route::get('/categories/{module}', 'Admin\CategoriesController@getHome')->name('categories');
	Route::post('/categories/add', 'Admin\CategoriesController@postCategoryAdd')->name('category_add');
	Route::get('/categories/{id}/edit', 'Admin\CategoriesController@getCategoryEdit')->name('category_edit');
	Route::post('/categories/{id}/edit', 'Admin\CategoriesController@postCategoryEdit')->name('category_edit');
	Route::get('/categories/{id}/delete', 'Admin\CategoriesController@getCategoryDelete')->name('category_delete');
	//Asesres
	Route::get('/asesores', 'Admin\AsesoresController@getHome')->name('asesores');
	Route::post('/asesores/add', 'Admin\AsesoresController@postAsesorAdd')->name('asesor_add');
	Route::get('/asesores/{id}/edit', 'Admin\AsesoresController@getAsesorEdit')->name('asesor_edit');
	Route::post('/asesores/{id}/edit', 'Admin\AsesoresController@postAsesorEdit')->name('asesor_edit');
	Route::get('/asesores/{id}/delete', 'Admin\AsesoresController@getAsesorDelete')->name('asesor_detele');
});