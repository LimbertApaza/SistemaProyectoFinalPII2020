<?php
require_once "../modelos/Pagos.php";

$pago=new Pago();

//Variables
$idpago=isset($_POST["idpago"])? limpiarCadena($_POST["idpago"]):"";
$idtransaccion=isset($_POST["idprestamo"])? limpiarCadena($_POST["idtransaccion"]):"";
$usuario=isset($_POST["usuario"])? limpiarCadena($_POST["usuario"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$cuota=isset($_POST["cuota"])? limpiarCadena($_POST["cuota"]):"";

switch($_GET["op"]){
        
    case 'guardaryeditar':
        if(empty($idtransaccion)){
            $rspta=$transaccion->insertar($idtransaccion,$usuario,$fecha,$cuota);
            echo $rspta ? "Pago Registrado" : "Pago No se Pudo Registrar";
        }
        else
        {
          $rspta=$transaccion->editar($idtransaccion,$idtransaccion,$usuario,$fecha,$cuota);
            echo $rspta ? "Pago Actualizado" : "Pago no se pudo actualizar";
        }
    break;
        
    case 'eliminar':
        $rspta=$transaccion->eliminar($idpago);
        echo $rspta ? "Pago Eliminado" : "Pago no se puede eliminar";
    break;
        
    case 'mostrar':
        $rspta=$transaccion->mostrar($idtransaccion);
        //Codificar resultado con json
        echo json_encode($idtransaccion);
    break;
        
    case 'listar':
        $rspta=$transaccion->listar();
        //declaracion de array
        $data=Array();
        
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
            "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idtransaccion.')"> <i class="fa fa-pencil"> </i></button>'.
 			    ' <button class="btn btn-danger" onclick="eliminar('.$reg->idtransaccion.')"> <i class="fa fa-trash"> </i></button>',
            "1"=>$reg->cliente,
            "2"=>$reg->usuario,
            "3"=>$reg->fecha,
            "4"=>$reg->cuota);
        }
        $results = array(
        "sEcho"=>1, //Informacion para el datatables
            "iTotalRecords"=>count($data), //Enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //Enviamos el total de registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);
    break;
        
    case 'selectPrestamo':
        require_once "../modelos/Prestamos.php";
		$transaccion = new transaccion();
		$rspta = $transaccion->select();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idtransaccion . '>' . $reg->nombre . '</option>';
        }
	break;
}
?>