<?php


require_once "../modelos/equipos.modelo.php";
session_start();

class TablaEquiposReport{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idTipoEquipo;
  	public $idObra;

	public function mostrarTablaEquiposArrendados(){

	   if($this->idTipoEquipo == ''){		     
		      $filtro = null;
		      $idObra = $this->idObra;  
       }else{       	  
		      $filtro = $this->idTipoEquipo;  
		      $idObra = $this->idObra;  	    
       }
      
  		$productos = ModeloEquipos::mdlMostrarEquiposArrendados($filtro,$idObra);
 		
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

		  			  	
		  			  	
		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarEquipo' idGuiaDetalle='".$productos[$i]["idGuiaDetalle"]."' idEquipoParaRetiro='".$productos[$i]["idEquipo"]."'>Seleccion</button></div>"; 

		  	$datosJson .='[      
			       "'.$botones.'",
			      "'.$productos[$i]["codigo"].'",			      
			      "'.$equipo.'",		
			      "'.$productos[$i]["guia"].'"     
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
  $activarProductosVentas = new TablaEquiposReport();
  $activarProductosVentas -> idTipoEquipo = $_POST["idTipoEquipo"];
  $activarProductosVentas -> idObra = $_POST["idObra"];
  $activarProductosVentas -> mostrarTablaEquiposArrendados();
}else{
  $activarProductosVentas = new TablaEquiposReport();
  $activarProductosVentas -> idTipoEquipo = '';
  $activarProductosVentas -> idObra = $_POST["idObra"];
  $activarProductosVentas -> mostrarTablaEquiposArrendados();
}

