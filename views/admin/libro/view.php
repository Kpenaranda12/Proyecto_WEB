<h2><?=$title?></h2><br>

<?php echo form_open_multipart(base_url() . 'administracion/Libros/filtro'); ?>
<div class="container">
  <div class="row">
    <div class="col-sm">
    <select name="categoria_id" class="form-control">
    <option value="0" disabled selected>Seleccione una categoria</option>
     <?php foreach ($categorias as $categoria): ?>
    <option value="<?php echo $categoria['id_cat']; ?>"><?php echo $categoria['nombre']; ?></option>
  
     <?php endforeach;?>

    </select>
    </div>
    <div class="col-sm">
    <button type="submit" class="btn btn-Success">Filtrar</button>
    </div>
  </div>
</div>
</form>

<br>
<!-- Muestro los datos que quiero que el cliente vea sobre el libro-->
<a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
<a class="btn btn-success" href="<?php echo base_url(); ?>administracion/Libros/create">Crear Libro</a>
<br>
<?php
if (empty($libros)) {?>
    <center>
    <h2 class="text-muted">No existen registros</h2>
    </center>
    <?php
} else {
    ?>
    <br>
<?php foreach ($libros as $libro): ?>
<h4>Titulo: <?php echo $libro['titulo']; ?> </h4>
 </a></p>
<div class="row">
<div class="col-md-3">
<img class="libros-thumb" src="<?php echo base_url(); ?>public/images/libros/<?php echo $libro['libro_imagen']; ?>">
</div>
<div class="col-md-9">
	<h6 class="libros-fecha">Fecha de Publicación ['Año-Mes-Dia']: <?php echo $libro['fecha_de_publicion']; ?></h6>
 	<h6>Categoria: <?php echo $libro['titulo']; ?></h6>
	<h5> Autor:   <?php echo $libro['autor']; ?> </h5>
  <h5> Estado Libro:  <?php $valor_fin = "0";
    $valor_inc = $libro['cantidad'];
    if ($valor_inc > $valor_fin) {
        echo 'Disponible';
    } else {
        echo "Agotado";
    }
    ?> </h4>
	<p><a class="btn btn-outline-info" href="<?php echo base_url();?>administracion/Libros/view/<?php echo $libro['slug']; ?>">Ver mas Información</a>
    
    <div class="btn-group">
        <a class="btn btn-danger" href="<?php echo base_url();?>administracion/Libros/delete/<?php echo $libro['id_libro']; ?>">Eliminar</a>
		<a class="btn btn-primary" href="<?php echo base_url();?>administracion/Libros/edit/<?php echo $libro['slug']; ?>">Editar</a>
    </div>
    </div>
    </div>
<?php endforeach;?>

    <?php

}
