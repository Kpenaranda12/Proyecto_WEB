<br>
<?php echo form_open(base_url().'Usuario/login'); ?>
<div class="row text-center">
		<!--Para poner el form en el centro-->
        <div class="col-md-4 col-md-offset-4">
        </div>
		<div class="col-md-4 col-md-offset-4">
			<!--Clase bootstrap para que se vea-->
			<h1 class="text-center"><?php echo $title; ?></h1>
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="Ingrese el nombre de usuario" required autofocus>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Ingrese la contraseña" required autofocus>
			</div>
			<!--Botton de Ingreso -->
  			<button type="submit" class="btn btn-Success btn-block">Iniciar</button><br>
			  <a href="<?php echo base_url(); ?>Usuario/create"><button type="button" class="btn btn-info">Registrar Nuevo usuario</button></a>
  		</div>
  	</div>
</form>
 <!--Se ciera el formato -->
<?php echo form_close(); ?>