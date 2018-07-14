
	<div class="btn-group1">
<h2><?php echo $libro['titulo']; ?> </h2>
<h6 class="libros-fecha">Fecha de Publicación ['Año-Mes-Dia']: <?php echo $libro['fecha_de_publicion']; ?></h6>
<img src="<?php echo base_url(); ?>public/images/libros/<?php echo $libro['libro_imagen']; ?>" width="250">
<div class="libros-autor">
	<h5>Autor: <?php echo $libro['autor']; ?> </h5>
	<br>
	<h5>Edicion: <?php echo $libro['edicion']; ?> </h5>
	<br>
	<h5>País: <?php echo $libro['pais']; ?> </h5>
	<br>
	<h5>Resumen:</h5> <?php echo $libro['resumen']; ?>
	<br><br>
	<p><a class="btn btn-info" href="<?php echo base_url(); ?>administracion/Libros">Volver a listado de Libros</a>
	<a class="btn btn-outline-success" href="<?php echo base_url('/reservas/create/'.$libro['id_libro']); ?>">Reservas del libro</a></p>
</div>
<hr>

