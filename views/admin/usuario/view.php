<h2><?=$title?></h2>

<div class="container-fluid">
  <div class="row">
  <a class="btn btn-info" href="<?php echo base_url(); ?>admin">Volver a menu</a>
  <a class="btn btn-warning" href="<?php echo base_url(); ?>administracion/Usuario/create">Nuevo</a>

    <div class="col-sm">
    <div >
    <br>
    <table class="table table-striped table-hover table-sm">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Correo</th>
      <th scope="col">Usuario</th>
      <th scope="col">Contraseña</th>
      <th scope="col">Contacto</th>
      <th scope="col">Perfil</th>
      <th scope="col">Eliminar</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody> 

  <?php foreach ($users as $user): ?>
  <tr>
  <td><?php echo $user['nombre']; ?> </td>
  <td><?php echo $user['apellido']; ?> </td>
  <td><?php echo $user['correo']; ?> </td>
  <td><?php echo $user['username']; ?> </td>
  <td><?php echo $user['password']; ?> </td>
  <td><?php echo $user['telefono']; ?> </td>
  <?php
if ($user['rol'] == '1') {?>
     <td>Administrador</td>
<?php
} else {
    ?>
    <td>Usuario</td>
<?php
}
?>

  <td><a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>administracion/Usuario/delete/<?php echo $user['id_user']; ?>">Eliminar</a>
   </td>
<td><a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>administracion/Usuario/edit/<?php echo $user['slug']; ?>">Editar</a></td>
</tr>
  <?php endforeach;?>

  </tbody>

  </table>
  </div>
  </div>
  </div>
  </div>