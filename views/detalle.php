<div class="container">
<h2><?php echo $libro['titulo']; ?> </h2>
<h6 class="libros-fecha">Fecha de Publicación ['Año-Mes-Dia']: <?php echo $libro['fecha_de_publicion']; ?></h6>
  <div class="row">
    <div class="col-sm">
	<img src="<?php echo base_url(); ?>public/images/libros/<?php echo $libro['libro_imagen']; ?>" width="500">
	<h5>Autor: <?php echo $libro['autor']; ?> </h5>
	<br>
	<h5>Edicion: <?php echo $libro['edicion']; ?> </h5>
	<br>
	<h5>País: <?php echo $libro['pais']; ?> </h5>
	<br>
	<h5>Ejemplares disponibles: <?php echo $libro['cantidad']; ?> </h5>
	<br>
	<h5>Resumen:</h5> <?php echo $libro['resumen']; ?>
	<p><a class="btn btn-info" href="<?php echo base_url(); ?>Libros">Volver a listado de Libros</a>
    </div>
    <div class="col-sm">
	
	<a class="btn btn-outline-success" href="<?php echo base_url('/reservas/create/'.$libro['id_libro']); ?>">Reservas del libro</a></p>
	<a class="btn btn-outline-warning" href="<?php echo base_url(); ?>Parametros">Parametros del alquiler</a>
    </div>


  </div>
</div>

