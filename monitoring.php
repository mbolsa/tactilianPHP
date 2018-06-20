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
  <head>
  <title>Monitoring</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="form-group">
          <h2> Actividades realizadas </h2>
          <?php
          $activities = $conexion->query("select a.genericActivity, g.name, a.id FROM activity a INNER JOIN genericActivity g ON a.genericActivity = g.id WHERE a.student = " . $_GET['student']);
          if ($activities->num_rows == 0)
          {
            echo "<p><b>No hay actividades asociadas al alumno</b></p>";
          }
          else
          {
            ?>
          <select class="form-control" size="10" id="chooser">
            <?php
            while ($activity = $activities->fetch_array())
            {
              echo "<option value='" . $activity[2] . "'>$activity[2] - $activity[1] </option>";
            }
            echo "</select>";
          }
            ?>
          <br>
        </div>
      </div>
      <div class="col-md-4 offset-md-2">
        <br>
        <br>
        <br>
        <br>
        <div class="wrapper">
          <div class="text-center">
            <span class="group-btn btn-group-justified ">
              <a href="#" class="btn btn-light btn-block" onClick="ir();"> Ver información</a>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  function ir()
  {
  var val = $("#chooser").val();
  window.location.replace("details.php?id="+val);
  }
  </script>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

<?php require_once("footer.php"); ?>
