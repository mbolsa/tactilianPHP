<html>
  <head>
  <title>Student</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="form-group text-center">
          <h2> EJECUCIÓN </h2>
          <br>
          <br>
          <span class="group-btn btn-group-justified">
            <a href="#" class="btn btn-light btn-block"> Iniciar </a>
          </span>
          <br>
          <br>
          <span class="group-btn btn-group-justified">
            <a href="#" class="btn btn-light btn-block"> Terminar </a>
          </span>
          <br>
          <br>
          <br>
          <div class="form-group text-center">
            <h4> Comentarios </h4>
          </div>
          <textarea class="form-control" placeholder="escriba comentarios aquí" name="description", rows = "5"></textarea>
        </div>
      </div>
      <div class="offset-md-2 col-md-5">
        <br>
        <br>
        <br>
        <div class="form-group text-center">
          <h4> Información </h4>
        </div>
        <div class="form-control">
          <p> Hora de Inicio:       00:00 </p>
          <p> Hora de Fin:          00:00 </p>
          <p> Alumno:               ----- </p>
          <p> Profesor:             ----- </p>
          <p> Respuesta:            ----- </p>
        </div>
      </div>
    </div>
  </div>

<?php require_once("footer.php"); ?>          

