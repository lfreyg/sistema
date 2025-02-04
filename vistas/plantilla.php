<?php

session_start();
date_default_timezone_set('America/Santiago');
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>SISTEMA GESTIÓN DE ARRIENDOS</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/fyb_logo.png">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

   <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.css">

  <link rel="stylesheet" href="vistas/bower_components/alertify/alertify.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

   
    
    <script src="vistas/bower_components/datatables.net/js/dataTables.buttons.min.js"></script>
    <script src="vistas/bower_components/datatables.net/js/buttons.flash.min.js"></script>
    <script src="vistas/bower_components/datatables.net/js/jszip.min.js"></script>
    <script src="vistas/bower_components/datatables.net/js/pdfmake.min.js"></script>
    <script src="vistas/bower_components/datatables.net/js/vfs_fonts.js"></script>
    <script src="vistas/bower_components/datatables.net/js/buttons.html5.min.js"></script>
    <script src="vistas/bower_components/datatables.net/js/buttons.print.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/Chart.js/Chart.js"></script>

  <script src="vistas/bower_components/select2/dist/js/select2.full.js"></script>

  <script src="vistas/bower_components/alertify/alertify.js"></script>




</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
 
  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

   echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabezote.php";

    /*=============================================
    MENU
    =============================================*/

    include "modulos/menu.php";

    
   //ESTADOS DE EQUIPOS
    define("DISPONIBLE",1);
    define("ENOBRA", 2);
    define("SERVICIOTECNICO",3);
    define("DEBAJA",4);
    define("TRASLADO",5);
    define("ROBADO",6);

    //OFICINA CENTRAL
    define("CENTRAL",1);

    //ESTADO PEDIDOS
    define("CONSTRUCCION",7);
    define("PENDIENTE",8);
    define("FINALIZADO",9);

    //ESTADO EQUIPO PEDIDO, GUIA, REPORT
    define("ARRIENDO",10);
    define("CAMBIO",11);
    define("TERMINO",15);

    //VALOR IVA
    define("VALOR_IVA",19);
    /*=============================================
    CONTENIDO
    =============================================*/

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "usuarios" ||
         $_GET["ruta"] == "sucursales" ||
         $_GET["ruta"] == "categorias" ||
         $_GET["ruta"] == "tipo-equipos" ||
         $_GET["ruta"] == "categorias" ||
         $_GET["ruta"] == "productos" ||
         $_GET["ruta"] == "proveedores" ||       
         $_GET["ruta"] == "constructoras" ||     
         $_GET["ruta"] == "obras" ||     
         $_GET["ruta"] == "marcas" ||    
         $_GET["ruta"] == "facturas-compra-equipos" ||     
         $_GET["ruta"] == "factura-detalles" || 
         $_GET["ruta"] == "carga-masiva-precios" || 
         $_GET["ruta"] == "descargar-listado-precios-nuevos" || 
         $_GET["ruta"] == "pedido-equipos" ||
         $_GET["ruta"] == "pedido-equipos-detalle" ||
         $_GET["ruta"] == "guia-despacho-arriendos" ||
         $_GET["ruta"] == "guia-despacho-arriendos-detalle" ||
         $_GET["ruta"] == "devolucion-equipos-arriendos" ||
         $_GET["ruta"] == "devolucion-equipos-arriendos-detalle" ||
         $_GET["ruta"] == "firma-report" ||
         $_GET["ruta"] == "transportista" ||
         $_GET["ruta"] == "mantenedor-equipos" ||
         $_GET["ruta"] == "carga-masiva-precios-lista" ||
         $_GET["ruta"] == "validacion-equipos-retiro" ||
         $_GET["ruta"] == "validacion-equipos-retiro-detalles" ||
         $_GET["ruta"] == "pedido-interno" ||
         $_GET["ruta"] == "pedido-interno-detalle" ||
         $_GET["ruta"] == "pedido-interno-despacho" ||
         $_GET["ruta"] == "pedido-interno-despacho-detalle" ||
         $_GET["ruta"] == "pedido-interno-despacho-detalle-vista" ||
         $_GET["ruta"] == "pedido-interno-validar" ||
         $_GET["ruta"] == "pedido-interno-despacho-detalle-vista-validar" ||
         $_GET["ruta"] == "pedido-interno-despacho-detalle-validar" ||
         $_GET["ruta"] == "eepp" ||
         $_GET["ruta"] == "obrasEEPP" ||
         $_GET["ruta"] == "equiposEEPP" ||
         $_GET["ruta"] == "eeppProcesado" ||
         $_GET["ruta"] == "eeppEdita" ||
         $_GET["ruta"] == "factura-eepp-constructora" ||
         $_GET["ruta"] == "obrasFacturacionEEPP" ||
         $_GET["ruta"] == "EEPPFacturar" ||
         $_GET["ruta"] == "asociar-oc" ||
         $_GET["ruta"] == "obrasOC" ||
         $_GET["ruta"] == "obras-oc-detalle" ||
         $_GET["ruta"] == "orden-compra-detalle" ||
         $_GET["ruta"] == "obras-factura-detalle" ||
         $_GET["ruta"] == "EEPPFacturarSeleccion" ||
         $_GET["ruta"] == "EEPPFacturarSeleccionOC" ||
         $_GET["ruta"] == "facturas-nc-nd" ||
         $_GET["ruta"] == "factura-nota-credito-listado" ||
         $_GET["ruta"] == "factura-nc-detalle" ||
         $_GET["ruta"] == "factura-nota-debito-listado" ||
         $_GET["ruta"] == "factura-nd-detalle" ||
         $_GET["ruta"] == "cambia-estado-equipos" ||
         $_GET["ruta"] == "usuarios-tipo-estado" ||
         $_GET["ruta"] == "aprobar-cambio-estado" ||
         $_GET["ruta"] == "talleres" ||
         $_GET["ruta"] == "guia-despacho-taller" ||
         $_GET["ruta"] == "guia-despacho-taller-detalle" ||
         $_GET["ruta"] == "costos-reparacion-equipos" ||
         $_GET["ruta"] == "despachar-pedido-equipos" ||
         $_GET["ruta"] == "ver-detalle-despachar-pedido-equipos" ||
         $_GET["ruta"] == "despachar-pedido-equipos-detalle" ||
         $_GET["ruta"] == "hoja-ruta" ||

         

        

         
         $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";

      }else{

        include "modulos/404.php";

      }

    }else{

      include "modulos/inicio.php";

    }

    
    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';

  }else{

    include "modulos/login.php";

  }

  ?>


<script src="vistas/js/plantilla.js?v=<?php echo(rand());?>"></script>
<script src="vistas/js/categorias.js?v=<?php echo(rand());?>"></script>
<script src="vistas/js/usuarios.js?v=<?php echo(rand());?>"></script>
<script src="vistas/js/sucursales.js?v=<?php echo(rand());?>"></script>
<script src="vistas/js/tipoEquipos.js?v=<?php echo(rand());?>"></script>
<script src="vistas/js/proveedores.js?v=<?php echo(rand());?>"></script>
<script src="vistas/js/constructoras.js?v=<?php echo(rand());?>"></script>
<script src="vistas/js/obras.js?v=<?php echo(rand());?>"></script>
<script src="vistas/js/marcas.js?v=<?php echo(rand());?>"></script>


</body>
</html>
