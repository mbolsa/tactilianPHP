<?php

session_start();
if (!isset($_SESSION["user"]))
{
  header("location:index.php");
}

?>
<html>
  <head>
  <title>Change Password</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-6">
        <div class="form-group has-feedback">
          <form method="post" action="change_passwd.change.php" id="change">
            <h4 class="display-4"> Cambiar contraseña </h4>
            <label class="control-label"> Contraseña actual </label>
            <input type="password" name="current_passwd" id="current_passwd" class="form-control input-sm chat-input", placeholder="Contraseña actual" required>
            <br>
            <label class="control-label"> Nueva contraseña </label>
            <input type="password" name="new_passwd" id="new_passwd" class="form-control input-sm chat-input" placeholder="Nueva contraseña" required>
            <br>
            <label class="control-label"> Repita nueva contraseña </label>
            <input type="password" name="new_passwd_repeat" id="new_passwd_repeat" class="form-control input-sm chat-input" placeholder="Nueva contraseña" required>
            <br>
            <input type="submit" class="btn btn-outline-warning btn-block" value="Cambiar"> 
          </form>
        </div>
      </div>
    </div>
  </div>

  <br>
  <br>

  <script>
  $('#change').submit(function(event) {  
    event.preventDefault();  
    var url = $(this).attr('action');  
    var datos = $(this).serialize();  
    $.post(url, datos, function(resultado) {
      if (resultado == 1)
      {
        alert("Se ha cambiado la contraseña correctamente");
		$("#current_passwd").val("");
		$("#new_passwd").val("");
		$("#new_passwd_repeat").val("");
      }
      else if (resultado == 2)
      {
        alert("Rellene todos los datos");
      }
      else if (resultado == 3)
      {
        alert("Las contraseñas nuevas no coinciden");
      }
      else if (resultado == 4)
      {
        alert("La contraseña antigua es incorrecta");
      }
      else
      {
        alert("ERROR");
      }
    });
  }); 
  </script>
  <?php require_once("footer.php"); ?>