<?php
include('../conexion.php');
$id = $_POST['id'];
$admin_id = $_POST['admin_id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$valor = $_POST['valor'];
$cantidad = $_POST['cantidad'];
$estado = 'activo';
$destinoFoto = '';


$query_validator = "SELECT * FROM productos WHERE id = '$id' OR nombre = '$nombre'";
$consulta_validator = mysqli_query($conexion, $query_validator);
if ($consulta_validator->num_rows == 0) {

	if ($_FILES['foto']['name'] != '') {

		$fotoOriginal = $_FILES['foto']['name'];
		$nombreFoto = strtolower(rand().$fotoOriginal);
		$cd = $_FILES['foto']['tmp_name'];
		$ruta = "../../admin/img/productos/".$fotoOriginal;
		$destinoFoto = "img/productos/".$nombreFoto;
		$resultado = @move_uploaded_file($cd, $ruta);
		if (!empty($resultado)){
			rename($ruta, "../../admin/".$destinoFoto);
		}
		else{
			$destinoFoto = "img/productos/defecto.jpg";
		}
	}
	else {
		$destinoFoto = "img/productos/defecto.jpg";
	}
	$query = "INSERT INTO `productos` (`id`, `admins_id`, `foto`, `nombre`, `descripcion`, `cantidad`, `valor`, `estado`) VALUES ('$id', '$admin_id', '$destinoFoto', '$nombre', '$descripcion', '$cantidad', '$valor', 'activo')";

	$consulta= mysqli_query($conexion,$query);
	echo '<script languaje="javascript">
	var mensaje ="El producto fue creado correctamente ";
	alert(mensaje);
	window.location.href= "../../admin/views/productos.php"
	</script>';
}
else {
	echo '<script languaje="javascript">
	var mensaje ="Alerta: No se guardo el producto, ya que existe en base de datos";
	alert(mensaje);
	window.location.href= "../../admin/views/productos.php"
	</script>';
}

?>
