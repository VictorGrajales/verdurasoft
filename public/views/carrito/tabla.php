<?php
@session_start();
if(!isset($_SESSION['id_usuario'])){
	  echo "<script languaje='javascript'>window.location.href= './carrito.php'</script>";
}
?>

<?php if(count($_SESSION['detalle']) > 0){?>
	<table class="table">
		<thead>
			<tr>
				<th>Productos</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Subtotal</th>
				<th>Accion</th>
			</tr>
		</thead>
		<tbody>
			<tbody>
				<?php
				$total = 0;
				foreach($_SESSION['detalle'] as $k => $detalle){
					$total += $detalle['subtotal'];
					?>
					<tr>
						<td><?php echo $detalle['producto'];?></td>
						<td><?php echo $detalle['cantidad'];?></td>
						<td><?php echo $detalle['precio'];?></td>
						<td><?php echo $detalle['subtotal'];?></td>
						<td><button class="eliminar-producto" onclick="deleteCarrito(<?php echo $detalle['id'];?>)">Eliminar</button></td>

						<!-- Necesario para la suma de cantidades -->
						<input type="hidden" id="<?php echo 'cantidadActual'.$detalle['id'];?>" value="<?php echo $detalle['cantidad'];?>">
					</tr>
				<?php }?>
				<tr>
					<td colspan="3" class="text-right">Total:</td>
					<td><?php echo $total;?></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	<?php }else{?>
		<div class="panel-body"> No hay productos agregados</div>
	<?php }?>
	<form action="../../../controllers/public/carrito.crud.php?page=3" method="post">
		<input type="submit" value="Comprar">
	</form>
