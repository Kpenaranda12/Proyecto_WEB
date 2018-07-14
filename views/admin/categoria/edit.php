<h2><?=$title?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart(base_url() . 'administracion/Categoria/update'); ?>
<input type="hidden" name="id" value="<?php echo $categorias['id_cat']; ?>">
  <div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="titulo" placeholder="Agregar categoria" value="<?php echo $categorias['nombre']; ?>"  required>
  </div>
  <a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
  <button type="submit" class="btn btn-Success">Actualizar</button>
</form>
