<h2><?=$title?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart(base_url() . 'administracion/Libros/update'); ?>
<input type="hidden" name="id" value="<?php echo $libro['id_libro']; ?>">
  <div class="form-group">
    <label>Titulo</label>
    <input type="text" class="form-control" name="titulo" placeholder="Agregar Titulo" value="<?php echo $libro['titulo']; ?>"  required>
  </div>
  <div class="form-group">
    <label>Autor</label>
    <input type="text" class="form-control" name="autor" placeholder="Agregar Autor" value="<?php echo $libro['autor']; ?>"  required>
  </div>
  <div class="form-group">
    <label>Fecha de Publicacion </label>
    <input type="date" max="2019-01-01" min="1500-01-01" name="fecha" placeholder="Agregar Fecha de Publicacion" value="<?php echo $libro['fecha_de_publicion']; ?>" required >
  </div>
  <div class="form-group">
    <label>Edicion</label>
    <input type="text" class="form-control" name="edicion" placeholder="Agregar Edicion o Serie" value="<?php echo $libro['edicion']; ?>" required >
  </div>
  <div class="form-group">
    <label>Cantidad</label>
    <input type="text" class="form-control" name="cantidad" placeholder="Agregar Cantidad" value="<?php echo $libro['cantidad']; ?>" required >
  </div>
  <div class="form-group">
    <label>País</label> required
    <input type="text" class="form-control" name="pais" placeholder="Agregar País" value="<?php echo $libro['pais']; ?>"  required>
  </div>
  <div class="form-group">
    <label>Resumen</label>
    <textarea id="texto1" class="form-control" name="resumen" placeholder="Agregar Resumen" required > <?php echo $libro['resumen']; ?></textarea>
  </div>
  <div class ="form-group">
    <label>Categoria</label>
    <select name="categoria_id" class="form-control">
     <?php foreach ($categorias as $categoria): ?>
<?php
if ($categoria['id_cat'] == $libro['categoria_id']) {?>
    <option value="<?php echo $categoria['id_cat']; ?>" selected><?php echo $categoria['nombre']; ?></option>
    <?php
} else {?>
    <option value="<?php echo $categoria['id_cat']; ?>"><?php echo $categoria['nombre']; ?></option>
    <?php
}
?>
     <?php endforeach;?>

    </select>
  </div>
  <a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
  <button type="submit" class="btn btn-Success">Actualizar</button>
</form>
