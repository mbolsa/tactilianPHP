<?php

session_start();
require_once("conexion.inc.php");
$conexion = new mysqli($servidor, $usuario, $passwd, $basedatos);
if (mysqli_connect_errno())
{
  echo "Error al establecer la conexión con la base de datos: " . mysqli_connect_error();
  exit();
}

$conexion->query("set names utf8");

?>
<html>
<html>
  <head>
  <title>Student</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
          <?php
            $information = $conexion->query("select p.name, g.name, p.surname FROM activity a, genericActivity g, person p WHERE a.genericActivity = g.id and a.student = p.id and a.id = " . $_GET['activity']);
            $infor = $information->fetch_array();
          echo "<h2> Ejecución de actividad <b>$infor[1]</b> para el alumno <b>$infor[0] $infor[2]</b></h2>";

?>          
      <div class="col-md-5">
        <div class="form-group text-center">
          <br>
          <br>
          <span class="group-btn btn-group-justified">
            <a href="#" class="btn btn-light btn-block"> Iniciar </a>
          </span>
          <br>
          <br>
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

