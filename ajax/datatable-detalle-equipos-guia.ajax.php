<?php


require_once "../modelos/equipos.modelo.php";
session_start();

class TablaEquiposGuiaDespacho{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idTipoEquipo;

	public function mostrarTablaEquiposParaArriendoGuia(){

	   if($this->idTipoEquipo == ''){	
		      $id = $_SESSION['idSucursalParaUsuario'];
		      $filtro = null;
       }else{
       	  $id = $_SESSION['idSucursalParaUsuario'];
		      $filtro = $this->idTipoEquipo;    	    
       }
      
  		$productos = ModeloEquipos::mdlMostrarEquiposGuiaDespacho($id, $filtro);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		   
		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

  			$equipo = $productos[$i]["descripcion"]." ".$productos[$i]["modelo"]." ".$productos[$i]["marca"];

		  			  	
		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarEquipoArriendo' idEquipoParaArriendo='".$productos[$i]["idEquipo"]."'>Agregar</button></div>"; 

		  	$datosJson .='[      
			      "'.$productos[$i]["codigo"].'",			      
			      "'.$equipo.'",			     		     
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
       // var_dump($datosJson);

		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 

if(isset($_POST["idTipoEquipo"])){
  $activarProductosVentas = new TablaEquiposGuiaDespacho();
  $activarProductosVentas -> idTipoEquipo = $_POST["idTipoEquipo"];
  $activarProductosVentas -> mostrarTablaEquiposParaArriendoGuia();
}else{
  $activarProductosVentas = new TablaEquiposGuiaDespacho();
  $activarProductosVentas -> idTipoEquipo = '';
  $activarProductosVentas -> mostrarTablaEquiposParaArriendoGuia();
}

