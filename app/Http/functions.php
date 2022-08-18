<?php  
	function getModulesArray(){
		$a = [
			'0' => 'Productos',
			'1' => 'Blog'
			];
		return $a;
	}
	
	function getRolUserArray($mode, $id){
		$roles = [
				  '0' => 'Cliente Basico',
				  '1' => 'Administrador'
				];
		if(!is_null($mode)):
				return $roles;
		else:
				return $roles[$id];
		endif;
	}
	function getStatusUserArray($mode, $id){
		$status = ['0' => 'Registrado',
				  '1' => 'Verificado',
				  '100' => 'Suspendido'];
		if(!is_null($mode)):
				return $status;
		else:
				return $status[$id];
		endif;
	}
	//ke value from json
	function kvfj($json, $key){
		if($json == null){
			return null;
		}else {
			$json = $json;
			$json = json_decode($json, true);
			if(array_key_exists($key, $json)){
				return $json[$key];
			}else {
				return null;
			}
		}
	}
?>