<?php

require_once "conexion.php";

class ModeloTransportista{

	/*=============================================
	CREAR CHOFER
	=============================================*/

	static public function mdlIngresarTransportista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(rut,nombre,patente,rut_empresa_transporte) VALUES (:rut,:nombre,:patente,:empresa)");

		$stmt->bindParam(":rut", str_replace(".","",strtoupper($datos['rut'])), PDO::PARAM_STR);
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":patente", strtoupper($datos['patente']), PDO::PARAM_STR);
		$stmt->bindParam(":empresa", str_replace(".","",strtoupper($datos['empresa'])), PDO::PARAM_STR);
				

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CHOFER
	=============================================*/

	static public function mdlMostrarTransportistas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and eliminado = false");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where eliminado = false");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR CHOFER
	=============================================*/

	static public function mdlEditarTransportista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET patente = :patente, rut_empresa_transporte = :empresa WHERE id = :id");

		$stmt -> bindParam(":patente", strtoupper($datos["patente"]), PDO::PARAM_STR);
		$stmt -> bindParam(":empresa", str_replace(".","",strtoupper($datos["empresa"])), PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);		
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CHOFER
	=============================================*/

	static public function mdlBorrarTransportista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEstadoEliminaTransportista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET eliminado = true WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidarEliminar($idTransporte){
		
			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho WHERE id_transporte_guia = $idTransporte limit 1");

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEmpresaTransporte($rut){
		if($rut != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM empresa_transporte WHERE rut = $rut");
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM empresa_transporte");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;
	}


	static public function mdlHojaRutaChofer($idTransporte){
		
			$stmt = Conexion::conectar()->prepare("SELECT c.nombre as constructora, o.nombre as obra, gd.numero_guia, o.comuna FROM guia_despacho_detalle gdd JOIN guia_despacho gd ON gdd.id_guia = gd.id JOIN constructoras c ON gd.id_constructoras = c.id JOIN obras o ON gd.id_obras = o.id WHERE gd.id_transporte_guia = $idTransporte and gdd.validado = 1 and gd.estado_guia = 13 and gdd.registro_eliminado = 0 GROUP BY gd.numero_guia ORDER BY o.comuna");

			$stmt -> execute();

			return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}

