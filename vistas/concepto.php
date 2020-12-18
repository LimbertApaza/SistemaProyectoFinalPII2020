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

if ($_SESSION['Escritorio']==1)
{
?>
    <!-- Inicio Contenido PHP-->
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <h2 class="box-title">Top de Trabajadores</h2>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header">
                                <h2>Top de Mejor Solictud de Trabajo</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <form enctype="multipart/form-data" method="post" action="upload.php">
                                <p>Elige los mejores segun listas
                                <input type="file" name="user-file">
                                </p>
                                <div class="helper-text">Elige un imagen de los trabajadores</div>
                                <button type="submit" class="btn btn-default btn-block">Cargar Imagen</button>
                            </form>
                        </div>
                    </div>
                </header>


                <div class="row">
                    <div class="main-box-body clearfix" >
                    <div class="col-sm-4">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4 style="font-size: 17px;">Actividades del Dia</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="main-box-body clearfix" >
                    <div class="col-sm-4">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4 style="font-size: 17px;">Pagos del Dia</h4>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="main-box-body clearfix" >
                    <div class="col-sm-4">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4 style="font-size: 17px;">Transacciones del Dia</h4>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="main-box-body clearfix" >
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
        <script type="text/javascript" src="scripts/clientes.js"></script>
<?php 
}
ob_end_flush();
?>

