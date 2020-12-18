<?php
//session_start(); 
require_once "../modelos/pedidos.php";

$prestamo=new Prestamo();

$idprestamo=isset($_POST["idtransaccion"])? limpiarCadena($_POST["idtransaccion"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$usuario=isset($_POST["usuario"])? limpiarCadena($_POST["usuario"]):"";
$fprestamo=isset($_POST["ftransaccion"])? limpiarCadena($_POST["ftransaccion"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$interes=isset($_POST["adelanto"])? limpiarCadena($_POST["adelanto"]):"";
$saldo=isset($_POST["saldo"])? limpiarCadena($_POST["saldo"]):"";
$formapago=isset($_POST["formapago"])? limpiarCadena($_POST["formapago"]):"";
$fechapago=isset($_POST["fechapago"])? limpiarCadena($_POST["fechapago"]):"";
$plazo=isset($_POST["plazo"])? limpiarCadena($_POST["plazo"]):"";
$fplazo=isset($_POST["fplazo"])? limpiarCadena($_POST["fplazo"]):"";
//$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtransaccion)){
			$rspta=$transaccion->insertar($idcliente,$usuario,$ftransaccion,$monto,$adelanto,$saldo,$formapago,$fechapago,$plazo,$fplazo);
			echo $rspta ? "Pedido registrado" : "Pedido no se pudo registrar";
		}
		else {
			$rspta=$transaccion->editar($idtransaccion,$idcliente,$usuario,$ftransaccion,$monto,$adelanto,$saldo,$formapago,$fechapago,$plazo,$fplazo);
			echo $rspta ? "Pedido actualizada" : "Pedido no se pudo actualizar";
		}
	break;
        
    case 'eliminar':
		$rspta=$transaccion->eliminar($idtransaccion);
 		echo $rspta ? "Pedido eliminado" : "Pedido no se puede eliminar";
	break;

	case 'cancelado':
		$rspta=$transaccion->cancelado($idtransaccion);
 		echo $rspta ? "Pedido Cancelado" : "Pedido no se puede Cancelar";
	break;

	case 'mostrar':
		$rspta=$transaccion->mostrar($idtransaccion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
	$rspta=$transaccion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
               "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idtransaccion.')"> <i class="fa fa-pencil"> </i></button>'.
 			        ' <button class="btn btn-danger" onclick="eliminar('.$reg->idtransaccion.')"> <i class="fa fa-trash"> </i></button>',
 				"1"=>$reg->cliente,
 				"2"=>$reg->usuario,
 				"3"=>$reg->fecha,
 				"4"=>$reg->monto,
                "5"=>$reg->adelanto,
 				"6"=>$reg->saldo,
 				"7"=>$reg->formapago,
 				"8"=>$reg->fechap,
                "9"=>$reg->plazo,
                "10"=>$reg->fechaf,
 				"11"=>($reg->estado)?'<span class="label bg-success">Activado</span>':
 				'<span class="label bg-danger">Cancelado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;
        
    case 'selectCliente':
        require_once "../modelos/Clientes.php";
		$cliente = new Clientes();
		$rspta = $cliente->select();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idcliente . '>' . $reg->nombre . '</option>';
        }
	break;
        
    case "selectUsuario":
        require_once "../modelos/Usuarios.php";
        $usuario = new Usuarios();
        
        $rspta = $usuario->select();
        
        while($reg = $rspta->fetch_object())
        {
            echo '<option value='.$reg->idusuario .'>'.$reg->nombre .'</option>';
        }
    break;
}
?>