<?php

session_start();
if (!isset($_SESSION["user"]))
{
  header("location:index.php");
}
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
  <title>Teacher Home</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container main-container">
    <?php
      $type = $conexion->query("select type FROM person WHERE id = " . $_SESSION["user"]["id"]);
      $t = $type->fetch_array();
      if ($t[0] == 3) {
      ?>
        <div class="col-md-3 offset-md-10">
          <h6><a href="register.php">Registrar nuevo usuario</a></h6>
        </div>
      <?php
      }
      ?>
    <div class="row justify-content-center">
      <div class="col-md-offset-2 col-md-3">
        <h1><a href="students.php">Lista de alumnos</a></h1>
      </div>
      <div class="col-md-offset-2 col-md-3">
        <h1><a href="activities.php">Lista de actividades</a></h1>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-offset-2 col-md-3">
        <h1><a href="pictograms.php">Lista de pictogramas</a></h1>
      </div>
      <div class="col-md-offset-2 col-md-3">
      </div>
    </div>
  </div>

  <br>
  <br>

  <?php require_once("footer.php"); ?>