<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart(base_url().'administracion/Usuario/update'); ?>
<input type="hidden" name="id" value="<?php echo $user['id_user']; ?>">
<input type="hidden" name="id_rol" value="<?php echo $user['rol']; ?>">
  <div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" placeholder="Agregar Nombre" value="<?php echo $user['nombre']; ?>" required> 
  </div>
  <div class="form-group">
    <label>Apellido</label>
    <input type="text" class="form-control" name="apellido" placeholder="Agregar Apellido" value="<?php echo $user['apellido']; ?>" required> 
  </div>
  <div class="form-group">
    <label>Correo</label>
    <input type="text" class="form-control" name="correo" placeholder="Agregar Correo" value="<?php echo $user['correo']; ?>" required> 
  </div>
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username" placeholder="Agregar Username" value="<?php echo $user['username']; ?>" required> 
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="password" placeholder="Agregar Contraseña" value="<?php echo $user['password']; ?>" required> 
  </div>
  <div class="form-group">
    <label>Telefono</label>
    <input type="text" class="form-control" name="telefono" placeholder="Agregar Telefono" value="<?php echo $user['telefono']; ?>" required> 
  </div>
   <div class ="form-group">
   <a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
  <button type="submit" class="btn btn-Success">Actualizar</button>
</form>