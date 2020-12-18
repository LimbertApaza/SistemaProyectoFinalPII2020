<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['Pedidos']==1)
{
?>
    <!-- Inicio Contenido PHP-->
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                     <h2 class="box-title">Pedidos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h2>
                </header>
                <div class="main-box-body clearfix" id="listadoregistros">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover" id="tbllistado">
                            <thead>
                                <tr>
                                   <th>Opciones</th>
                                    <th>Clientes</th>
                                    <th>Usuarios</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Adelanto</th>
                                    <th>Saldo</th>
                                    <th>Tip/Pago</th>
                                    <th>Fechas</th>
                                    <th>Plazo</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
                </div>
                
                   <div class="main-box-body clearfix" id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                           <div class="form-group col-md-6 col-sm-9 col-xs-12">
                            <label>Cliente</label>
                            <input type="hidden" name="idprestamo" id="idprestamo">
                            <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" required></select>                           
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                           <label>Usuarios</label>
                            <select name="usuario" id="usuario" class="form-control selectpicker" data-live-search="true" required></select> 
                            <input type="hidden" class="form-control" name="fpedidos" id="fprestamo" required>
                        </div>                          
                        </div>
                        <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Monto</label>
                            <input type="number" name="monto" id="monto" class="form-control" placeholder="Monto" required>
                            <input type="hidden"  id="valor" >
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Adelanto</label>
                            <select class="form-control select-picker" name="Adelanto" id="Adelanto" required>
                              <option value="20">75 %</option>
                              <option value="15">50 %</option>
                              <option value="13">25 %</option>
                              <option value="10">10 %</option>
                            </select>
                        </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Saldo</label>
                            <input type="number" name="saldo" id="saldo" class="form-control" placeholder="Saldo" required >
                        </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                            <label>Tipo de Pago</label>
                            <select class="form-control select-picker" name="formapago" id="formapago" required>
                              <option value="Diario">Dinero Fisico</option>
                              <option value="Semanal">Tarjeta Credito</option>
                              <option value="Quincenal">Paypal</option>
                              <option value="Mensual">Creditos</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Fecha pago:</label>
                            <input type="date" class="form-control" name="fechapago" id="fechapago" required >

                          </div>
                        </div>
                         <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                            <label>Plazo</label>
                            <select class="form-control select-picker" name="plazo" id="plazo" required>
                              <option value="Dia">2 Horas</option>
                              <option value="Semana">3 Horas</option>
                              <option value="Quincena">4 Horas</option>
                              <option value="Mes">Limitado</option>
                            </select>
                        </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Fecha Cancelacion</label>
                            <input type="date" class="form-control" name="fplazo" id="fplazo" required >
                          </div>
                         </div>
                        <div class="form-group col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->
    <?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script>
$(document).ready(function($){
var mont;
	$('#monto').keyup(function (e) {
		mont = $(this).val();
	 //console.log(mont)	  
	})

		$('select#Adelanto').on('change',function(){
		     var valor = $(this).val(); 
			 var subt = mont * (valor/100);
			 var total = parseFloat(subt) + parseFloat(mont);			
			 $("#saldo").val(total);		
		})

sumaDias = function(d, fecha)
{
 var Fecha = new Date();
 var sFecha = fecha || (Fecha.getDate() + "-" + (Fecha.getMonth() +1) + "-" + Fecha.getFullYear());
 var sep = sFecha.indexOf('-') != -1 ? '-' : '-';
 var aFecha = sFecha.split(sep);
 var fecha = aFecha[2]+'-'+aFecha[1]+'-'+aFecha[0];
 fecha= new Date(fecha);
 fecha.setDate(fecha.getDate()+parseInt(d));
 var anno=fecha.getFullYear();
 var mes= fecha.getMonth()+1;
 var dia= fecha.getDate();
 mes = (mes < 10) ? ("0" + mes) : mes;
 dia = (dia < 10) ? ("0" + dia) : dia;
 var fechaFinal = dia+sep+mes+sep+anno;
 return (fechaFinal);
 }

 $('select#formapago').on('change',function(){
		     var valor = $(this).val(); 
			 if(valor == 'Diario'){
			 	$('#fechapago').val(sumaDias(1));
			 }
				 if(valor == 'Semanal'){
				 	$('#fechapago').val(sumaDias(7));
				 }
					 if(valor == 'Quincenal'){
					 	$('#fechapago').val(sumaDias(15));
					 }
						 if(valor == 'Mensual'){
						 	$('#fechapago').val(sumaDias(30));
						 }
		})

  $('select#plazo').on('change',function(){
		     var valor = $(this).val(); 
			 if(valor == 'Dia'){
			 	$('#fplazo').val(sumaDias(1));
			 }
				 if(valor == 'Semana'){
				 	$('#fplazo').val(sumaDias(7));
				 }
					 if(valor == 'Quincena'){
					 	$('#fplazo').val(sumaDias(15));
					 }
						 if(valor == 'Mes'){
						 	$('#fplazo').val(sumaDias(30));
						 }
		})
})
</script>
<script type="text/javascript" src="scripts/Pedidos.js"></script>
<!--<script type="text/javascript" src="scripts/prestamos.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>-->

<?php 
}
ob_end_flush();
?>

