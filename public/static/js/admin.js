let base = location.protocol+'//'+location.host;
let route = document.getElementsByName(`routName`)[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function() {
	if(route == "product_edit" ){
	let btn_product_file_image = document.getElementById('btn_product_file_image');
	let product_file_image = document.getElementById('product_file_image');
	btn_product_file_image.addEventListener('click', function(){
		product_file_image.click(); //llamar a la funcion click
	}, false);
	product_file_image.addEventListener('change', function() {
		document.getElementById('form_product_gallery').submit();
	});
	}
	route_active = document.getElementsByClassName(`lk-`+route)[0].classList.add('active');
});