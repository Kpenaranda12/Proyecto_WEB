<center>
<br><br>
<h2>Administración del sistema</h2>
<h4>Bienvenido</h4>
<img src="<?php echo base_url(); ?>public/images/admin.png" width="150"/>
</center><br>
<div class="container">
  <div class="row">
    <div class="col-sm-3">
    <a class="btn btn-outline-info" href="<?php echo base_url(); ?>administracion/Categoria">GESTION CATEGORIAS</a>
    </div>
    <div class="col-sm-3">
    <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>administracion/Usuario">GESTION USUARIOS</a>
    </div>
    <div class="col-sm-3">
    <a class="btn btn-outline-warning" href="<?php echo base_url(); ?>administracion/Libros">GESTION LIBROS</a>
    </div>
    <div class="col-sm-3">
    <a class="btn btn-outline-danger" href="<?php echo base_url(); ?>administracion/Multas">GESTION MULTAS</a>
    </div>

  </div>
  <br>
  <div class="row">
   <div class="col-sm-3">
    <a class="btn btn-outline-warning" href="<?php echo base_url(); ?>administracion/Reservas/create">REALIZAR RESERVAS</a>
    </div>
    <div class="col-sm-3">
    <a class="btn btn-outline-info" href="<?php echo base_url(); ?>administracion/Parametros">PARAMETROS</a>
    </div>
    <div class="col-sm-3">
    <a class="btn btn-outline-danger " href="<?php echo base_url(); ?>administracion/Reporte">REPORTE</a>
    </div>
  </div>
</div>
