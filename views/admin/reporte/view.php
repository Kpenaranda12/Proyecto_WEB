
<h2><?=$title?></h2>
<?php
foreach ($parametros as $p):
    $costo = $p['multa_por_dia'];
    $ddd = $p['dias_devolucion'];
    ?>
		  <?php
    $fecha = '+' . $ddd . ' days';
    ?>

		   <?php
endforeach;
?><br>
<a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>



<?php
echo form_open_multipart('administracion/Reporte/filtro');
?>

<br>
<span class="text-center"><h5>Reservas</h5></span>
<div class="container">
  <div class="row">
    <div class="col-sm">
    <div class="form-group">
<label>Fecha Prestado </label>
<input type="date"  name="fecha_de_reserva"  class="form-control" >
o
<label>Fecha devolución </label>
<input type="date"  name="fecha_de_devolucion"  class="form-control" >
</div>
    </div>
    <div class="col-sm">
    <div class="form-group">
    <label>Estado </label>
    <select name="estado" class="form-control" >
    <option value="" disabled selected>Seleccionar estado de fecha</option>
      <option value="Prestado">Prestado</option>
      <option value="Devuelto">Devuelto</option>

    </select>

</div>
    </div>
    <div class="col-sm">
    <label>Libro </label>
    <select name="libro_id" class="form-control" >
    <option value="" disabled selected>Seleccionar libro</option>
        <?php
foreach ($libros as $libro): ?>
<option value="<?php echo $libro['id_libro']; ?>"><?php echo $libro['titulo']; ?></option>
?>


     <?php endforeach;?>

    </select>

    </div>
  </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-sm">
    <label>Usuario</label>
    <select name="users_id" class="form-control" >
    <option value="" disabled selected>Seleccionar usuario</option>
     <?php
foreach ($users as $user):
?>
      <option value="<?php
echo $user['id_user'];
?>"><?php
echo $user['username'];
?></option>
     <?php
endforeach;
?>
    </select>
   <?php
foreach ($parametros as $p):
?>
    <input type="hidden" name="parametros_id" class="form-control" readonly="readonly" value="<?php
echo $p['id_par'];
?>" required>
   <?php
endforeach;
?>
    </div>
    <div class="col-sm">


    </div>
    <div class="col-sm">
    <label>Buscar</label><br>
    <button type="submit" class="btn btn-Success">Buscar</button>
    </div>
  </div>
</div>

</form>
<br>

<div class="container">
  <div class="row">
    <div class="col-sm">
    <div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Libro</th>
      <th scope="col">Usuario</th>
      <th scope="col">Fecha reserva</th>
      <th scope="col">Fecha devolución</th>
      <th scope="col">Fecha de entrega</th>
      <th scope="col">Detalle</th>
      <th scope="col">Accion</th>
      <th scope="col">Estado</th>
    </tr>
  </thead>
  <tbody>
  <?php
foreach ($reservas as $reserva):
?>
								    <tr>
								    <?php
foreach ($libros as $libro):
    if ($libro['id_libro'] == $reserva['libro_id']) {
        ?>
																		  <th scope="row"><?php
    echo $libro['titulo'];
        ?></th>
																		<?php
    }
endforeach;
?>
								      <td>
								      <?php
foreach ($users as $user):
    if ($user['id_user'] == $reserva['users_id']) {
        echo $user['username'];
    }
endforeach;
?>
								      </td>
								      <td><?php
echo $reserva['fecha_de_reserva'];
?></td>
								      <td><?php
echo $reserva['fecha_de_devolucion'];
?></td>

					        <td><?php
foreach ($multas as $m) {
    if ($m['id_reserv'] === $reserva['id_reserv']) {
        echo $m['fecha_pago'];
    }
}
?></td>

						  <?php
$exp_date = $reserva['fecha_de_devolucion'];
$today_date = date('Y-m-d');
$exp = strtotime($exp_date);
$td = strtotime($today_date);
if ($td > $exp) {
    ?>
					 <?php
$fecha_dev = $reserva['fecha_de_devolucion'];
    $today_date = date('Y-m-d');
    $count = abs(strtotime($today_date) - strtotime($fecha_dev));
    $day = $count / 86400;
    $precio = $day * $costo;
    ?>
					                <td>A pagar  multa de:$ <?php echo $precio; ?>- <?php echo $day; ?> dias de atraso</td>

						            <?php
} else {
    ?>
							    <td>
						Sin Multas
						</td>
						          <?php
}
?>

        					        <td><?php
foreach ($multas as $m) {
    if ($m['id_reserv'] === $reserva['id_reserv']) {
        ?>
				                Pago realizado de multa de:$ <?php echo $m['total_Multa']; ?>- <?php echo $m['dias']; ?> dias de atraso

				<?php
} else {

    }
}
?></td>
								  <td> <?php
echo $reserva['estado'];
?></td>

								    </tr>


								    <?php
endforeach;
?>
  </tbody>
</table>
</div>
    </div>
  </div>
</div>
