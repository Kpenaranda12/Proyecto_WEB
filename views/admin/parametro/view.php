<h2><?= $title ?></h2>

<!-- Errores de validacion-->
<?php echo validation_errors(); ?>

<!-- Tag para nuestro form -->
<?php echo form_open_multipart(base_url().'administracion/Parametros/update'); ?>
<input type="hidden" name="id" value="<?php echo $parametros['id_par']; ?>">
  <div class="form-group">
    <label>Nombre Parametro</label>
    <input type="text" class="form-control" name="title" placeholder="Nombre de Parametro" value="<?php echo $parametros['title']; ?>" required>
    <label>Multa por dia:</label>
    <input type="text" class="form-control" name="multa" placeholder="Ingresa el numero de dias" value="<?php echo $parametros['multa_por_dia']; ?>" required>
  </div>
    <div class="form-group">
  <!--Campos necesario -->
    <label>Copias Maximas:</label>
    <input type="text" class="form-control" name="copias" placeholder="Ingresa las copias maximas" value="<?php echo $parametros['copias']; ?>" required>
  </div>
    <div class="form-group">
  <!--Campos necesario -->
    <label>Dias de devolucion</label>
    <input type="text" class="form-control" name="dias" placeholder="Ingresa el numero de dias de Devolucion" value="<?php echo $parametros['dias_devolucion']; ?>" required>
  </div>

  <!--Botton de registrar -->
   <div class ="form-group">
   <a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
  <button type="submit" class="btn btn-Success">Editar</button>
</form>
