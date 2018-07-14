<!-- Se procede a poner el titulo-->
<h2><?=$title?></h2>
<?php
foreach ($parametros as $p):

    $costo = $p['multa_por_dia'];

endforeach;
?>
<a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
<br><br>
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
      <th scope="col">Fecha actual</th>
      <th scope="col">Atraso</th>
      <th scope="col">Cobrar</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
  <?php
foreach ($reservas as $reserva):
    $exp_date = $reserva['fecha_de_devolucion'];
    $today_date = date('Y-m-d');
    $exp = strtotime($exp_date);
    $td = strtotime($today_date);
    if ($td > $exp) {
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
		        <td><?php echo date('Y-m-d'); ?></td>
	            <?php
    $fecha_dev = $reserva['fecha_de_devolucion'];
            $today_date = date('Y-m-d');
            $count = abs(strtotime($today_date) - strtotime($fecha_dev));
            $day = $count / 86400;
            $precio = $day * $costo;
            ?>
	            <td><?php echo $day ?> días</td>
		        <td>$ <?php echo $precio ?></td>
		                <td>
		                   <a class="btn btn-outline-info" href="<?php echo base_url('Reservas/devolverPago/' . $reserva['id_reserv']); ?>">Pagar y Devolver</a>

		              </td>
		                            </tr>
		                        <?php
    }
    }

endforeach;
?>
  </tbody>
</table>
</div>
    </div>


    <div class="col-sm">
    <div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Libro</th>
      <th scope="col">Usuario</th>
      <th scope="col">Fecha reserva</th>
      <th scope="col">Fecha devolución</th>
      <th scope="col">Fecha de pago</th>
      <th scope="col">Pago Relizado</th>
      <th scope="col">Estado Libro</th>
    </tr>
  </thead>
  <tbody>
  <?php

foreach ($reservas as $reserva):
    foreach ($multas as $m) {
        if ($m['id_reserv'] == $reserva['id_reserv']) {
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
    echo $m['fecha_pago'];
                ?></td>

<td>Multa de:$ <?php echo $m['total_Multa']; ?>- <?php echo $m['dias']; ?> dias de atraso</td>
	                              <td> <?php
    echo $reserva['estado'];
                ?></td>
                <td<?php
    echo $reserva['estado'];
                ?>></td>
	                                </tr>
	                            <?php
    }
        }
    }
endforeach;
?>
  </tbody>
</table></div>
    </div>
  </div>
</div>