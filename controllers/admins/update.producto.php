<?php
include('../conexion.php');
<<<<<<< HEAD
$new_id = $_POST['id'];
$id = $_POST['id_old'];

$new_nombre = $_POST['nombre'];
$nombre = $_POST['nombre_old'];

$descripcion = $_POST['descripcion'];
$valor = $_POST['valor'];
$cantidad = $_POST['cantidad'];
$foto = $_POST['foto_old'];
$estado = 'activo';

// Validador de cantidad.
if ($cantidad <= 0) {
	$estado = 'inactivo';
}

// Validacion de nuevo id
if ($new_id != $id) {
	$sql_id = "SELECT * FROM productos WHERE id = '$new_id'";
	$consulta_id = mysqli_query($conexion, $sql_id);
	if ($consulta_id->num_rows != 0) {
		echo '<script languaje="javascript">
		var mensaje ="El producto ya existen en base de datos.";
		alert(mensaje);
		window.location.href= "../../admin/views/productos.php"
		</script>';
	}
}

// Validacion de nuevo nombre
if ($new_nombre != $nombre) {
	$sql_nombre = "SELECT * FROM productos WHERE nombre = '$new_nombre'";
	$consulta_nombre = mysqli_query($conexion, $sql_nombre);
	if ($consulta_nombre->num_rows != 0) {
		echo '<script languaje="javascript">
		var mensaje ="El producto ya existen en base de datos.";
		alert(mensaje);
		window.location.href= "../../admin/views/productos.php"
		</script>';
	}
}

// Subir foto
if ($_FILES['foto']['name'] != '') {

	$fotoOriginal = $_FILES['foto']['name'];
	$nombreFoto = strtolower(rand().$fotoOriginal);
	$cd = $_FILES['foto']['tmp_name'];
	$ruta = "../../admin/img/productos/".$fotoOriginal;
	$destinoFoto = "img/productos/".$nombreFoto;
	$resultado = @move_uploaded_file($cd, $ruta);
	if (!empty($resultado)){

		// Renombrar nueva foto
		rename($ruta, "../../admin/".$destinoFoto);

		// Elimina la foto vieja
		if ($foto != 'img/productos/defecto.jpg') {
			unlink('../../admin/'.$foto);
		}
	}
	else{
		$destinoFoto = $foto;
	}
}
else {
	$destinoFoto = $foto;
}

	$query= "UPDATE productos SET id = '$new_id', foto = '$destinoFoto', nombre = '$new_nombre', descripcion = '$descripcion', cantidad = '$cantidad', valor = '$valor', estado = '$estado' WHERE id = '$id' ";
	$consulta= mysqli_query($conexion, $query);

	if ($consulta) {
		echo '<script languaje="javascript">
=======
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$valor = $_POST['valor'];
$cantidad = $_POST['cantidad'];
$estado = $_POST['estado'];


$sqli_igual = "SELECT nombre from productos WHERE nombre = '$nombre'";
$consulta2 = mysqli_query($conexion, $sqli_igual);
$mostrar = mysqli_fetch_array($consulta2);
if ($nombre != $mostrar['nombre'] )
{

	$query_validator = "SELECT * FROM productos WHERE id = '$id' OR nombre = '$nombre'";
	$consulta_validator = mysqli_query($conexion, $query_validator);
	if ($consulta_validator->num_rows == 0) {

	$query= "UPDATE `productos` SET `nombre` = '".$nombre."', `descripcion` = '".$descripcion."', `cantidad` = '".$cantidad."', `valor` = '".$valor."', `estado` = '".$estado."' WHERE `productos`.`id` = '".$id."' ";
	$consulta= mysqli_query($conexion,$query);
	echo '<script languaje="javascript">
>>>>>>> 9019f5ef6dd6faa370230cb428f1840a3b32e772
		var mensaje ="El producto fue ACTUALIZADO correctamente";
		alert(mensaje);
		window.location.href= "../../admin/views/productos.php";
		</script>';
	}
	else {
		echo '<script languaje="javascript">
<<<<<<< HEAD
		var mensaje ="Hubo un problema al actualizar el producto, intenta mas tarde.";
		alert(mensaje);
		window.location.href= "../../admin/views/productos.php";
		</script>';
	}

=======
		var mensaje ="Alerta: No se actualizó el producto, ya que existe en base de datos";
		alert(mensaje);
		window.location.href= "../../admin/views/productos.php"
		</script>';
	}
}
>>>>>>> 9019f5ef6dd6faa370230cb428f1840a3b32e772

?>
