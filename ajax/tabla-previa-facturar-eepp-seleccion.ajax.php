<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/obras.modelo.php";
require_once "../controladores/eepp.controlador.php";

 
$idFactura = $_GET['idFactura'];

$estado = 12;
ModeloFacturacionEEPP::mdlActualizaEstadoFactura($idFactura, $estado);

$eeppCobro = ControladorFacturacion::ctrMostrarEEPPFacturacionSeleccion($idFactura);

 ModeloFacturacionEEPP::mdlEliminarRegistrosFacturaSII($idFactura);

?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablas" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="10%">Periodo EEPP</th>
                  <th width="5%">Fecha EEPP</th>
                  <th width="5%">Fecha Cierre</th>   
                  <th width="10%">Monto EEPP</th>
                  <th width="5%"><div align="center">Ver</div></th>  
                  
                </tr>

    </thead>
     <tbody>
   
  <?php
                                  
            for($i = 0; $i < count($eeppCobro); $i++){   

              $id_eepp = $eeppCobro[$i]["id_eepp"];
              $fecha_eepp = $eeppCobro[$i]["fecha_eepp"];
              $fecha_corte = $eeppCobro[$i]["fecha_corte"];
              $total_equipos = $eeppCobro[$i]["total_equipos"];
              $idObra = $eeppCobro[$i]["id_obras"];


              $dateReg = date_create($fecha_corte);
              $mes = date_format($dateReg,"m");
              $anno = date_format($dateReg,"Y");
              $nombreMes = ControladorEEPP::ctrNombreMeses($mes);

              $periodo = $nombreMes.'-'.$anno;
              

                        
            

              
              //FORMATEO DE FECHAS
               if($fecha_eepp != null){
                $dateReg1 = date_create($fecha_eepp);
                $fecha_eepp = date_format($dateReg1,"d-m-Y");
              }

              if($fecha_corte != null){
                $dateReg2 = date_create($fecha_corte);
                $fecha_corte = date_format($dateReg2,"d-m-Y");
              }
             
           
              //FIN FORMATEO DE FECHAS

             $materiales = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaMateriales($id_eepp);

             if($materiales){
                $montoMat = $materiales['total'];
             }else{
                $montoMat = 0;
             }

             $extras = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaExtras($id_eepp);

             if($extras){
                $montoextras = $extras['total'];
             }else{
                $montoextras = 0;
             }

             $dscto = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaDscto($id_eepp);

             if($dscto){
                $montodscto = $dscto['total'];
             }else{
                $montodscto = 0;
             }

             
            $total_facturacion_eepp = $total_equipos + $montoMat + $montoextras + $montodscto;


             $factura = ModeloFacturacionEEPP::mdlMontoFacturadoEEPP($id_eepp);

              if(!$factura){
                $montoFacturado = 0;
              }else{
                $montoFacturado = $factura["totalFactura"];
              }

              $nc = ModeloFacturacionEEPP::mdlMontoNotaCredito($id_eepp);

              if(!$nc){
                $montonc = 0;
              }else{
                $montonc = $nc["totalNC"];
              }

               $nd = ModeloFacturacionEEPP::mdlMontoNotaDebito($id_eepp);

              if(!$nd){
                $montond = 0;
              }else{
                $montond = $nd["totalND"];
              }

               $totalFacturado = ($montoFacturado + $montond) + $montonc;



              $saldo = $total_facturacion_eepp - $totalFacturado;


                          

             
            
  ?>
  <tr>    
    <td ><div align="left"><?php echo $periodo?></div></td> 
    <td ><div align="center"><?php echo $fecha_eepp?></div></td> 
    <td ><div align="center"><?php echo $fecha_corte?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($saldo,0,'','.')?></div></td>
    <td align="center" nowrap=""><button class="btn btn-warning btn-xm" onclick="verEEPPSel('<?php echo $id_eepp?>','<?php echo $idObra?>')">Ver EEPP</button>
      </td> 
  </tr>
  <?php
                
               $datos = array("idFactura"=>$idFactura,
                              "codigo"=>null,
                              "descripcion"=>'Arriendos '.$periodo,
                              "glosa"=>null,
                              "cantidad"=> 1,
                              "um"=> 'GL',
                              "precio"=> $saldo,
                              "valor"=> $saldo,
                              "id_eepp"=>$id_eepp

                                                                   
             );  

               $valida = ModeloFacturacionEEPP::mdlInsertarRegistrosFacturaSII($datos);

               
            }  

  ?>
   </tbody>
</table>

   </tbody>
</table>






   



