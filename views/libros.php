<h2><?= $title ?></h2>
<?php echo form_open_multipart(base_url() . 'Libros/filtro'); ?>
<div class="container">
  <div class="row">
    <div class="col-sm">
    <select name="categoria_id" class="form-control" required>
    <option value="" disabled selected>Seleccione una categoria</option>
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
<!-- Muestro los datos que quiero que el cliente vea sobre el libro-->

<?php
if(empty($libros))
{
echo "No existen registros";
}
else
{
foreach ($libros as $libro) : ?>
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
  <h5> Estado Libro:  <?php $valor_fin= "0";
    $valor_inc = $libro['cantidad'];
    if($valor_inc > $valor_fin)
    {
    echo 'Disponible';
    }
    else{
    echo "Agotado";
    }
    ?> </h4>
	<p><a class="btn btn-outline-info" href="<?php echo base_url('/Libros/view/'.$libro['slug']); ?>">Ver mas Información</a>
    </div>
    </div><br>
<?php endforeach; 
}
?>