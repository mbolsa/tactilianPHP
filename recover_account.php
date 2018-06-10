<html>
  <head>
  <title>Recover Account</title>
  
  
<?php require_once("header.php"); ?>



  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-5">
        <div class="form-group has-feedback">
          <form method="post" action="">
            <h4 class="display-4"> Recuperar cuenta </h4>
            <label class="control-label"> Introduce el correo electrónico </label>
            <input type="email" name="email" pattern="^[a-z0-9._%+-]{6,20}@[a-z0-9.-]{1,20}\.[a-z]{2,3}$" class="form-control input-sm chat-input", placeholder="Email" required>
            <br>
            <input type="submit" class="btn btn-outline-warning btn-block" value="Enviar email de recuperación">
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>

  <?php require_once("footer.php"); ?>