<?php

/*=============================================
Mostrar errores
=============================================*/

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "C:/xampp/htdocs/pos/php_error_log");

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/sucursales.controlador.php";
require_once "controladores/tipoEquipos.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/perfiles.controlador.php";
require_once "controladores/proveedores.controlador.php";
require_once "controladores/constructoras.controlador.php";
require_once "controladores/obras.controlador.php";
require_once "controladores/marcas.controlador.php";
require_once "controladores/facturasCompra.controlador.php";
require_once "controladores/equipos.controlador.php";
require_once "controladores/cargaMasivaPrecios.controlador.php";
require_once "controladores/pedidoEquipo.controlador.php";
require_once "controladores/guiaDespacho.controlador.php";
require_once "controladores/reportDevolucion.controlador.php";
require_once "controladores/transportista.controlador.php";
require_once "controladores/pedidoInterno.controlador.php";
require_once "controladores/eepp.controlador.php";
require_once "controladores/facturacion.controlador.php";
require_once "controladores/ordenCompra.controlador.php";
require_once "controladores/facturaNC.controlador.php";
require_once "controladores/facturaND.controlador.php";
require_once "controladores/talleres.controlador.php";
require_once "controladores/guiaDespachoTaller.controlador.php";
require_once "controladores/comunas.controlador.php";

require_once "modelos/categorias.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/sucursales.modelo.php";
require_once "modelos/tipoEquipos.modelo.php";
require_once "modelos/perfiles.modelo.php";
require_once "modelos/proveedores.modelo.php";
require_once "modelos/constructoras.modelo.php";
require_once "modelos/obras.modelo.php";
require_once "modelos/marcas.modelo.php";
require_once "modelos/facturasCompra.modelo.php";
require_once "modelos/facturasDetalles.modelo.php";
require_once "modelos/facturasDetalles.modelo.php";
require_once "modelos/equipos.modelo.php";
require_once "modelos/cargaMasivaPrecios.modelo.php";
require_once "modelos/pedidoEquipo.modelo.php";
require_once "modelos/empresasOperativas.modelo.php";
require_once "modelos/transporteGuia.modelo.php";
require_once "modelos/guiaDespacho.modelo.php";
require_once "modelos/reportDevolucion.modelo.php";
require_once "modelos/reportDevolucionDetalles.modelo.php";
require_once "modelos/transportista.modelo.php";
require_once "modelos/pedidoInterno.modelo.php";
require_once "modelos/eepp.modelo.php";
require_once "modelos/materiales.modelo.php";
require_once "modelos/facturacion.modelo.php";
require_once "modelos/facturacionOC.modelo.php";
require_once "modelos/ordenCompra.modelo.php";
require_once "modelos/facturacionNCND.modelo.php";
require_once "modelos/estados.modelo.php";
require_once "modelos/talleres.modelo.php";
require_once "modelos/guiaDespachoTaller.modelo.php";

require_once "extensiones/vendor/autoload.php";



$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();