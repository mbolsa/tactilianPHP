<html>
  <head>
  <title>Register</title>
  
  
<?php require_once("header.php"); ?>

  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-6">
        <div class="form-group has-feedback">
          <form method="post" action="">
            <h4 class="display-4"> Registro </h4>
            <label class="control-label"> Nombre </label>
            <input type="text" name="name" id="nombre" pattern="^.{1,19}$" title="Entre 1 y 20 letras y/o espacios" class="form-control input-sm chat-input", placeholder="Nombre" required>
            <br>
            <label class="control-label"> Apellido </label>
            <input type="text" name="surname" id="apellido" pattern="^.{1,19}$" title="Entre 1 y 20 letras y/o espacios" class="form-control input-sm chat-input" placeholder="Apellido" required>
            <br>
            <label class="control-label"> Alias </label>
            <input type="text" name="nick" id="alias" pattern="^.{1,19}$" title="Entre 1 y 20 letras y/o espacios" class="form-control input-sm chat-input" placeholder="Alias">
            <br>
            <label class="control-label"> Email </label>
            <input type="email" name="email" id="correo" pattern="^[a-z0-9._%+-]{6,20}@[a-z0-9.-]{1,20}\.[a-z]{2,3}$" class="form-control input-sm chat-input" placeholder="Email" required>
            <br>
            <input type="submit" class="btn btn-light btn-block" value="Crear usuario!"> 
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <?php require_once("footer.php"); ?>