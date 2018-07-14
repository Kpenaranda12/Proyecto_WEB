<h2><?= $title ?></h2>
<!-- Muestro los datos que quiero que el cliente vea sobre el libro-->
<?php foreach ($parametros as $parametro) : ?>
<h5>Nombre Parametro: <?php echo $parametro['title']; ?> </h5>
	<br>
	<h5>Dias Multa: <?php echo $parametro['multa_por_dia']; ?> </h5>
	<br>
	<h5>Copias Maxima: <?php echo $parametro['copias']; ?> </h5>
	<br>
	<h5>Dias Maximo de Devolucion: <?php echo $parametro['dias_devolucion']; ?> </h5>
	<p><a class="btn btn-info" href="<?php echo base_url(); ?>Libros">Volver a listado de Libros</a>
<?php endforeach; ?>
