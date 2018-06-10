<html>
  <head>
  <title>Recover Account Password</title>
  
  
<?php require_once("header.php"); ?>



  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-6">
        <div class="form-group has-feedback">
          <form method="post" action="">
            <h4 class="display-4"> Recuperar cuenta </h4>
            <label class="control-label"> Nueva contraseña </label>
            <input type="password" name="new_passwd" id="new-passwd" class="form-control input-sm chat-input", placeholder="Nueva contraseña" required>
            <br>
            <label class="control-label"> Repetir nueva contraseña </label>
            <input type="password" name="new_passwd_repeat" id="repeat-new-passwd" class="form-control input-sm chat-input", placeholder="Nueva contraseña" required>
            <br>
            <input type="submit" id="change-passwd" class="btn btn-outline-warning btn-block" value="Cambiar">
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>

  <?php require_once("footer.php"); ?>
