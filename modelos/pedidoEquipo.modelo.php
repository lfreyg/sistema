<?php

require_once "conexion.php";

class ModeloPedidoEquipo{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarPedidoEquipo($idUsuario){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT pe.id as numero, c.nombre as constructora, o.nombre as obra, s.nombre as sucursal, u.nombre as usuario, e.descripcion as estado, pe.compartido as compartido, pe.documento as documento, pe.creado as creado, pe.orden_compra as oc FROM pedido_equipo pe join constructoras c on pe.id_constructoras = c.id join obras o on pe.id_obras = o.id join sucursales s on pe.id_sucursal = s.id join usuarios u on pe.id_usuario = u.id join estados e on pe.estado = e.id WHERE pe.id_usuario = $idUsuario ORDER BY pe.id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarPedidoEquipoUnico($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido_equipo WHERE id = $id");

		   $stmt -> execute();

		  return $stmt -> fetch();

		  $stmt -> close();

		  $stmt = null;

	}

	static public function mdlValidaExisteFacturaCompra($tabla, $datos){

		$id_proveedor = $datos["id_proveedor"];
		$factura = $datos["numero_factura"];

		$sql = Conexion::conectar()->prepare("SELECT * FROM facturas_compra_equipos where id_proveedor = $id_proveedor and numero_factura = $factura");
        
        $sql -> execute();
		return $sql -> fetch();
        
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
	static public function mdlEditarPedidoEquipo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_constructoras = :id_constructora, id_obras = :id_obra, id_sucursal = :id_sucursal, documento = :documento, orden_compra =:oc where id = :id");

		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);			
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);
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

	static public function mdlEliminarFacturasCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			$stmt2 = Conexion::conectar()->prepare("DELETE FROM equipos WHERE id_factura = :id");
			$stmt2 -> bindParam(":id", $datos, PDO::PARAM_INT);
			$stmt2 -> execute();

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	


	

	static public function mdlFacturaPorId($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("select * FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);		

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlSumaTotalFacturaCompra($anio){

		    $anno = $anio;

			$stmt = Conexion::conectar()->prepare("SELECT sum(e.precio_compra) as total FROM equipos e join facturas_compra_equipos fce on e.id_factura = fce.id where year(fce.fecha_factura) = $anno");	
			

			$stmt -> execute();
   		    return $stmt -> fetch();
		    $stmt -> close();
		    $stmt = null;

	}


}