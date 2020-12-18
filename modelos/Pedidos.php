<?php 
//Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";
    
Class Pedidos
{
    //implementamos nuestro constructor
    public function __construct()
    {   
    }
    
    //implementamos un metodo para insertar registros
    public function insertar($idcliente,$usuario,$fpedidos,$monto,$adelanto,$saldo,$formapago,$fechapago,$plazo,$fplazo)
    {
        $sql="INSERT INTO prestamos (idcliente,usuario,fprestamo,monto,interes,saldo,formapago,fpago,plazo,fplazo,estado) 
        VALUES ('$idcliente','$usuario','$fprestamo','$monto','$interes','$saldo','$formapago','$fechapago','$plazo','$fplazo','1')";
        return ejecutarConsulta($sql);
    }
    
    //Implementamos el metodo para Editar Registros
    public function editar($idpedidos,$idcliente,$usuario,$fpedidos,$monto,$interes,$saldo,$formapago,$fechapago,$plazo,$fplazo)
	{
		$sql="UPDATE Pedidos SET 
                     idcliente='$idcliente',
                     usuario='$usuario',
                     fprestamo='$fprestamo',
                     monto='$monto',
                     adelanto='$adelanto',  
                     saldo='$saldo',
                     formapago='$formapago',
                     fpago='$fechapago',
                     plazo='$plazo',
                     fplazo='$fplazo' 
                    WHERE idpedidos='$idpedidos'";
		return ejecutarConsulta($sql);
	}
    
    //Implementamos un método para eliminar categorías
	public function eliminar($idpedidos)
	{
		$sql="DELETE FROM Pedidos WHERE idpedidos='$idpedidos'";
		return ejecutarConsulta($sql);
	}
    
    //Implementamos un método para desactivar Clientes
	public function cancelado($idpedidos)
	{
		$sql="UPDATE Pedidos SET estado ='0' WHERE SaldoActual=0";
		return ejecutarConsulta($sql);
	} 
    
    //Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpedidos)
	{
		$sql="SELECT p.idprestamo,c.nombre as cliente,u.nombre as usuario,DATE(p.fprestamo) as fecha,p.monto,p.interes,p.saldo,p.formapago,DATE(p.fpago) as fechap,p.plazo,DATE(p.fplazo) as fechaf,p.estado 
        FROM Pedidos p INNER JOIN clientes c ON 
        p.idcliente=c.idcliente INNER JOIN usuarios u ON 
        p.usuario=u.idusuario";
		return ejecutarConsultaSimpleFila($sql);
	}
    
//mostrar lista de la tabla gastos    
    public function listar()
	{
		$sql="SELECT p.idprestamo,c.nombre as cliente,u.nombre as usuario,DATE(p.fprestamo) as fecha,p.monto,p.interes,p.saldo,p.formapago,DATE(p.fpago) as fechap,p.plazo,DATE(p.fplazo) as fechaf,p.estado 
        FROM Pedidos p INNER JOIN clientes c ON 
        p.idcliente=c.idcliente INNER JOIN usuarios u ON 
        p.usuario=u.idusuario";
		return ejecutarConsulta($sql);		
	}
    
    public function select()
	{
		$sql="SELECT p.idprestamo,c.nombre FROM Pedidos p INNER JOIN clientes c ON p.idcliente=c.idcliente WHERE p.estado=1 ORDER BY c.nombre ASC";
		return ejecutarConsulta($sql);		
	}

}

?>