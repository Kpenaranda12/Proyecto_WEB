<?php echo validation_errors(); ?>

<?php echo form_open_multipart(base_url().'administracion/Usuario/create'); ?>
    <div class="row">
      <div class="col-md 4 col-md-offset-4">
        <h1 class="text-center"><?= $title ?></h1>
        <div class="form-group">
          <label>Nombre</label>
          <input type="text" class="form-control" name="nombre" placeholder="Agregar Nombre" required>
        </div>
        <div class="form-group">
          <label>Apellido</label>
          <input type="text" class="form-control" name="apellido" placeholder="Agregar Apellido" required>
        </div>
        <div class="form-group">
          <label>Correo</label>
          <input type="email" class="form-control" name="correo" placeholder="Agregar Correo" required>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="username" placeholder="Agregar Username"  required> 
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" placeholder="Agregar Contraseña" required > 
        </div>
        <div class="form-group">
          <label>Telefono</label>
          <input type="number" class="form-control" name="telefono" placeholder="Agregar Telefono" required>
        </div>
        <div class="form-group">
        <a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
        <button type="submit" class="btn btn-Success">Registrar</button>
        </div>
    </div>
  </div>
</form>