<?php

require_once "conexion.php";

class ModeloReportDevolucion{

	/*=============================================
	MOSTRAR LISTA PARA TABLA DE REPORT
	=============================================*/

	static public function mdlMostrarReportDevolucion($idUsuario){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT rd.id as idReport, rd.id_constructoras as idConstructora, c.nombre as constructora, rd.id_obras as idObra, o.nombre as obra, rd.id_usuario as idUsuario, u.nombre, rd.documento as documento, rd.estado as estado, rd.fecha_report as creado FROM report_devolucion rd LEFT JOIN constructoras c ON rd.id_constructoras = c.id LEFT JOIN obras o ON rd.id_obras = o.id LEFT JOIN usuarios u ON rd.id_usuario = u.id where rd.id_usuario =  $idUsuario ORDER BY rd.id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarPedidoEquipoDetalle($id){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT pe.id as numero, c.nombre as constructora, o.nombre as obra, s.nombre as sucursal, u.nombre as usuario, e.descripcion as estado, pe.compartido as compartido, pe.documento as documento, pe.creado as creado, pe.orden_compra as oc FROM pedido_equipo pe join constructoras c on pe.id_constructoras = c.id join obras o on pe.id_obras = o.id join sucursales s on pe.id_sucursal = s.id join usuarios u on pe.id_usuario = u.id join estados e on pe.estado = e.id WHERE pe.id = $id");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarReportDevolucionUnico($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM report_devolucion WHERE id = $id");

		   $stmt -> execute();

		  return $stmt -> fetch();

		  $stmt -> close();

		  $stmt = null;

	}

	
	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarPedidoEquipo($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_constructoras, id_obras, id_sucursal, id_usuario, documento, orden_compra) VALUES (:id_constructora, :id_obra, :id_sucursal, :id_usuario, :documento, :oc)");

		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);		
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from pedido_equipo");
 
               $sql->execute();
               return $sql -> fetch();                 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR 
	=============================================*/
	static public function mdlEditarReportDevolucion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_constructoras = :id_constructora, id_obras = :id_obra, documento = :documento where id = :id");

		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);					
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);		
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR 
	=============================================*/

	static public function mdlEliminarPedidoEquipo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			$stmt2 = Conexion::conectar()->prepare("DELETE FROM pedido_equipo_detalle WHERE id_pedido_equipo = :id");
			$stmt2 -> bindParam(":id", $datos, PDO::PARAM_INT);
			$stmt2 -> execute();

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidaEquipoReportEliminar($idDevolucion){

		

			$stmt = Conexion::conectar()->prepare("SELECT gdd.* FROM guia_despacho_detalle gdd join equipos e ON gdd.id_equipo = e.id where gdd.devuelto = 1 and e.id_estado != 1 and gdd.id_devolucion = $idDevolucion");

			
			$stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}

	static public function mdlValidaEquipoReportEditar($idDevolucion){

		

			$stmt = Conexion::conectar()->prepare("SELECT gdd.* FROM guia_despacho_detalle gdd where gdd.id_devolucion = $idDevolucion");

			
			$stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}

		


}