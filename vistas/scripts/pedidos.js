var tabla;

//Funcion que se ejecuta al inicio
function init(){
    mostrarform(false);
    listar();
    
    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
    
    //Cargamos los items al select Cliente
	$.post("../ajax/pedidos.php?op=selectCliente", function(r){
	            $("#idcliente").append(r);
	            $('#idcliente').selectpicker('refresh');
	});
    
    //Cargamos los items al select Usuarios
    $.post("../ajax/pedidos.php?op=selectUsuario", function(r){
	            $("#usuario").append(r);
	            $('#usuario').selectpicker('refresh');
	});
}

//Funcion Limpiar
function limpiar(){
    $("#idpedidos").val("");
    $("#idcliente").val("");
    $("#usuario").val("");
    $("#fpedido").val("");
    $("#monto").val("");
    $("#adelanto").val("");
    $("#saldo").val("");
    $("#formapago").val("");
    $("#fechapago").val("");
    $("#plazo").val("");
    $("#fplazo").val("");
    $("#estado").val("");
    
    //Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fpedido').val(today);
    
}

//Mostrar Formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

function cancelarform()
{
    limpiar();
    mostrarform(false);
}


function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/pedidos.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/pedidos.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idprestamo)
{
	$.post("../ajax/pedidos.php?op=mostrar",{idpedidos : idpedidos}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcliente").val(data.cliente);
        $('#idcliente').selectpicker('refresh');
        $("#usuario").val(data.usuario);
        $('#usuario').selectpicker('refresh');
		$("#fpedido").val(data.fecha);
		$("#monto").val(data.monto);
		$("#adelanto").val(data.adelanto);
		$("#saldo").val(data.saldo);
		$("#formapago").val(data.formapago);
        $("#fechapago").val(data.fechap);
        $("#plazo").val(data.plazo);
        $("#fplazo").val(data.fechaf);
		$("#estado").val(data.estado);
		$("#idpedidos").val(data.idpedido);

 	});
    }
//Función para eliminar registros
function eliminar(idpedidos)
{
	bootbox.confirm("¿Está Seguro de eliminar el pedidos?", function(result){
		if(result)
        {
        	$.post("../ajax/pedidos.php?op=eliminar", {idpedidos : idpedidos}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}
init();

