<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart(base_url().'administracion/Libros/create'); ?>
  <!-- Los campos que se tiene para -->
  <div class="form-group">
    <label>Titulo</label>
    <input type="text" class="form-control" name="titulo" placeholder="Agregar Titulo" required>
  </div>
  <div class="form-group">
    <label>Autor</label>
    <input type="text" class="form-control" name="autor" placeholder="Agregar Autor" required>
  </div>
  <div class="form-group">
    <label>Fecha de Publicacion </label>
    <input type="date" max="2019-01-01" min="1500-01-01" name="fecha" placeholder="Agregar Fecha de Publicacion" required>
  </div>
  <div class="form-group">
    <label>Edicion</label>
    <input type="text" class="form-control" name="edicion" placeholder="Agregar Edicion o Serie" required>
  </div>
  <div class="form-group">
    <label>Cantidad</label>
    <input type="text" class="form-control" name="cantidad" placeholder="Agregar Cantidad" required>
  </div>
  <div class="form-group">
    <label>País</label>
    <input type="text" class="form-control" name="pais" placeholder="Agregar País" required>
  </div>
  <div class="form-group">
    <label>Resumen</label>
    <textarea id="texto1" class="form-control" name="resumen" placeholder="Agregar Resumen" required></textarea>
  </div>
   <!-- Que se muestre la categoria que estan disponible en mi tabla de categorias-->
  <div class ="form-group">
    <label>Categoria</label>
    <select name="categoria_id" class="form-control" required>
     <?php foreach ($categorias as $categoria): ?>
      <option value="<?php echo $categoria['id_cat']; ?>"><?php echo $categoria['nombre']; ?></option>
     <?php endforeach; ?>
    </select>
  </div>
  <!-- Para agregar imagenes-->
  <div class="form-group">
    <label>Upload Image</label>
    <input type="file" name="userfile" size="20">
  </div>
  <a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
  <button type="submit" class="btn btn-Success">Registro</button>
</form>
