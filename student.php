<html>
  <head>
	<title>Student</title>
	
	
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="form-group has-feedback">
          <form method="post" action="">
            <h2> Información del estudiante </h2>
            <label class="control-label"> Nombre </label>
            <input type="text" name="name" class="form-control input-sm chat-input", placeholder="Nombre">
            <br>
            <label class="control-label"> Apellidos </label>
            <input type="text" name="surname" class="form-control input-sm chat-input" placeholder="Apellidos">
            <br>
            <label class="control-label"> Alias </label>
            <input type="text" name="alias" class="form-control input-sm chat-input" placeholder="Apellidos">
            <br>
            <input type="submit" class="btn btn-light btn-block" name="actualizar" value="Actualizar"> 
            <br>
            <input type="submit" class="btn btn-outline-light btn-block" name="borrar" value="Borrar"> 
          </form>
        </div>
      </div>
      <div class="col-md-4 offset-md-2">
        <div class="wrapper">
          <div class="text-center">
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/catalog" class="btn btn-outline-light btn-block"> Registrar pictograma </a>
            </span>
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/catalog" class="btn btn-light btn-block"> Catálogo </a>
            </span>
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/monitoring" class="btn btn-light btn-block"> Seguimiento </a>
            </span>
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/linked_teachers" class="btn btn-light btn-block"> Profesores vinculados </a>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once("footer.php"); ?>