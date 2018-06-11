<?php

session_start();
if (!isset($_SESSION["user"]))
{
	header("location:index.php");
}

?>

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
          <form method="post" action="register.new.php" id="register">
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
            <input type="email" name="email" id="correo" pattern="^[a-z0-9._%+-]{1,37}@[a-z0-9.-]{1,20}\.[a-z]{2,3}$" class="form-control input-sm chat-input" placeholder="Email" required>
            <br>
            <select name="type">
              <option value="1">Alumno</option>
              <option value="2">Profesor</option>
            </select>
            <br>
            <?php if ($error == 1) echo "Email en uso"; ?>
            <input type="submit" class="btn btn-light btn-block" value="Crear usuario!"> 
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  
  <script>
  $('#register').submit(function(event) {  
  event.preventDefault();  
  var url = $(this).attr('action');  
  var datos = $(this).serialize();  
  $.post(url, datos, function(resultado) {
		if (resultado == 1)
		{
			alert("El usuario se ha añadido correctamente");
			$('#nombre').val("");
			$('#apellido').val("");
			$('#alias').val("");
			$('#correo').val("");
		}
		else if (resultado == 2)
		{
			alert("Rellene todos los datos");
		}
		else if (resultado == 3)
		{
			alert("El email introducido ya está registrado en la Base de Datos");
		}
		else
		{
			alert("ERROR");
		}
	});
}); 

</script>
  <?php require_once("footer.php"); ?>

<?php

