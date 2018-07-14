
<html>
<head>
    <title> Biblioteca Millenium</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    <script src="http://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
</head>
 <body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="<?php echo base_url(); ?>">Biblioteca Millenium</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>libros">Libros</a>
        </li>
        <?php if ($this->session->userdata('rol')=='1'): ?>
         <li class="nav-item">
         <a class="nav-link" href="<?php echo base_url(); ?>Admin">Administración</a>
      </li>
      <?php endif;?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if (!$this->session->userdata('logged_in')): ?>
        <li class="navbar-nav navbar-right">
        <a class="nav-link" href="<?php echo base_url(); ?>Usuario/login">Iniciar Sesión</a>

    <?php endif;?>
    <?php if ($this->session->userdata('rol')=='2'): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>Reservas/create">Mis Reservas</a>
        </li><?php endif;?>
        <?php if ($this->session->userdata('logged_in')): ?>
           <li class="navbar-nav navbar-right">
            <a class="nav-link" href="<?php echo base_url(); ?>Usuario/logout">Cerrar Sesión-(<?php echo $this->session->userdata('username');?>)</a>
        </li>
        <?php endif;?>
      </li>

      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <?php if ($this->session->flashdata('login_failed')): ?>
    <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
  <?php endif;?>

   <?php if ($this->session->flashdata('user_loggedin')): ?>
    <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
  <?php endif;?>
   <?php if ($this->session->flashdata('user_loggedout')): ?>
    <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
  <?php endif;?>
  <?php if ($this->session->flashdata('error')): ?>
    <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('error') . '</p>'; ?>
  <?php endif;?>
  <?php if ($this->session->flashdata('exito')): ?>
    <?php echo '<p class="alert alert-warning">' . $this->session->flashdata('exito') . '</p>'; ?>
  <?php endif;?>

  <br><br>
