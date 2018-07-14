
<br><br>
<center>
<h2 class="text-muted"><?= $title ?></h2>
</center>


<?php echo validation_errors(); ?>


<form class="cat-delete" action ="<?php echo base_url();?>administracion/Categoria/create" method="post">

<div class="form-group">

    <input type="text" class="form-control" name="nombre" placeholder="Ingresa la categoria" required>
  </div>


  <a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
  <button type="submit" class="btn btn-Success">Registrar</button>
</form>




<?php
if(empty($categorias))
{
?>
<center>
<h2 class="text-muted">No existen registros</h2>
</center>
<?php
}
else
{
?>

<center>
<h2 class="text-muted"><?= $title ?></h2>
</center>

<div class="container">
  <div class="row">
    <div class="col-sm">
    <div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($categorias as $categoria) : ?>
<tr>
<td><?php echo $categoria['nombre']; ?></td>
<td><a class="btn btn-danger btn-sm"href="<?php echo base_url('administracion/Categoria/delete/'.$categoria['id_cat']); ?>">Eliminar</a></td>
<td><a class="btn btn-warning btn-sm" href="<?php echo base_url('administracion/Categoria/edit/'.$categoria['id_cat']); ?>">Editar</a></td>

</tr>
<?php endforeach; ?>
  </tbody>
  </tbody>
</table></div>
    </div>
  </div>
</div>

<?php
}

?>
