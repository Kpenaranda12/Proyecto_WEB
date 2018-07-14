<!-- Se procede a poner el titulo-->
<h2><?=$title?></h2>
<?php
foreach ($parametros as $p):
?>
  <b>Información: </b>Devolución en  <?php
echo $p['dias_devolucion'];
$costo = $p['multa_por_dia'];
$ddd = $p['dias_devolucion'];
?>días
  <?php
$fecha = '+' . $ddd . ' days';
?>

   <?php
endforeach;
?><br>
<a class="btn btn-info" href="<?php echo base_url(); ?>Libros">Volver a Libros</a>

<?php
echo validation_errors();
?>

<?php
echo form_open_multipart('Reservas/create');
?>

<br>
<div class="form-group">

  <div class="form-group">
<label>Fecha de Reserva </label>
<input type="text" readonly="readonly" name="fecha" value="<?php
echo date('Y-m-d');
?>" required>
<label>Fecha de Devolucion </label>
<input type="text" readonly="readonly" name="devolucion"  value="<?php
echo date('Y-m-d', strtotime("$fecha"));
?>" required>
</div>
   <div class ="form-group">
    <label>Libro</label>


         <select name="libro_id" class="form-control" required>
        <?php
foreach ($libros as $libro): ?>
     <?php if($libro['id_libro']==$miIDlibro)
     {
            if ($libro['cantidad'] > 0) {?>
                    <option value="<?php echo $libro['id_libro']; ?>" selected><?php echo $libro['titulo'] . ' / ' . $libro['cantidad'] . ' disponibles '; ?></option>
                <?php
            } else {
                ?>
                        <option value="<?php echo $libro['id_libro']; ?>" selected disabled><?php echo $libro['titulo'] . ' / ' . $libro['cantidad'] . ' disponibles '; ?></option>
                    <?php
            }
     }
     else{
            if ($libro['cantidad'] > 0) {?>
                    <option value="<?php echo $libro['id_libro']; ?>"><?php echo $libro['titulo'] . ' / ' . $libro['cantidad'] . ' disponibles '; ?></option>
                <?php
            } else {
                ?>
                        <option value="<?php echo $libro['id_libro']; ?>" disabled><?php echo $libro['titulo'] . ' / ' . $libro['cantidad'] . ' disponibles '; ?></option>
                    <?php
        }
     }
     ?>


     <?php endforeach;?>

    </select>


    <div class ="form-group">
    <label>Usuario</label>
    <select name="users_id" class="form-control" required>
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
  <!--Botton de registrar -->
  <br>
  <button type="submit" class="btn btn-Success">Realizar</button>
</forms>
<br>
<br>
<span class="text-center"><h5>Reservas actuales</h5></span>
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
      <th scope="col">Proceso</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
  <?php
foreach ($reservas as $reserva):
    if ($reserva['estado'] == "Prestado") {
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
				                <td>Pago multa de:$ <?php echo $precio; ?>- <?php echo $day; ?> dias de atraso</td>
                                <td>
				       <a class="btn btn-outline-info" href="<?php echo base_url('Reservas/devolverPago/' . $reserva['id_reserv'] . '/' . $reserva['libro_id']); ?>">Pagar y Devolver</a>

				  </td>

					            <?php
    } else {
            ?>
						    <td>
					Sin Multas
					</td>
                    <td>
					     <a class="btn btn-outline-info" href="<?php echo base_url('Reservas/devolver/' . $reserva['id_reserv'] . '/' . $reserva['libro_id']); ?>">Devolver</a>
					</td>
					          <?php
    }
        ?>
							    </tr>
							<?php
    }
    ?>

							    <?php
endforeach;
?>
  </tbody>
</table>
</div>
    </div>

    <div class="col-sm">
    <div class="table-responsive">
    <span class="text-center"><h5>Historial Reservas finalizadas</h5></span>
    <table class="table table-striped table-hover table-sm">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Libro</th>
      <th scope="col">Usuario</th>
      <th scope="col">Fecha reserva</th>
      <th scope="col">Fecha devolución</th>
      <th scope="col">Fecha de pago</th>
      <th scope="col">Proceso</th>
      <th scope="col">Terminado</th>
    </tr>
  </thead>
  <tbody>
  <?php
foreach ($reservas as $reserva):
    if ($reserva['estado'] !== "Prestado") {
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
            } else {
            }
        }
        ?></td>

				        <td><?php
    foreach ($multas as $m) {
            if ($m['id_reserv'] === $reserva['id_reserv']) {
                ?>
			                Pago Multa de:$ <?php echo $m['total_Multa']; ?>- <?php echo $m['dias']; ?> dias de atraso

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
    }
    ?>

							    <?php
endforeach;
?>
  </tbody>
</table></div>
    </div>
  </div>
</div>
