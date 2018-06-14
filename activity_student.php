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
	<title>Catalog</title>
	
	
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <div class="form-group has-feedback">
          <?php
            $information = $conexion->query("select p.name, g.name, p.surname FROM activity a, genericActivity g, person p WHERE a.genericActivity = g.id and a.student = p.id and a.id = " . $_GET['activity']);
            $infor = $information->fetch_array();
          echo "<h2> Particularizar actividad <b>$infor[1]</b> para el alumno <b>$infor[0] $infor[2]</b></h2>";
          ?>
        </div>
      </div>
      <div class="col-md-5 offset-md-1">
        <h4> Seleccione pictograma del catálogo del alumno </h4>
        <div style="height:300px;overflow:auto;border:1px solid black;">
          <img src="images/prueba.png" width="200" height="200">
          <img src="images/prueba.png" width="200" height="200">
          <img src="images/prueba.png" width="200" height="200">
          <img src="images/prueba.png" width="200" height="200">
          <img src="images/prueba.png" width="200" height="200">
          <img src="images/prueba.png" width="200" height="200">
          <img src="images/prueba.png" width="200" height="200">
          <img src="images/prueba.png" width="200" height="200">
          <img src="images/prueba.png" width="200" height="200">
        </div>
        <br>
        <span class="group-btn btn-group-justified ">
          <a href="#" class="btn btn-light btn-block"> Imprimir </a>
        </span>
        <br>
        <span class="group-btn btn-group-justified ">
          <a href="#" class="btn btn-light btn-block"> Añadir </a>
        </span>
      </div>
      <div class="col-md-5 offset-md-1 wrapper">
        <div style="border:1px solid black;padding:5px;">
          <strong> Descripción: </strong>
        </div>
        <div style="border:1px solid black;margin-top:30px;padding:5px;">
          <p> Text.... </p>
        </div>
        <div class="col-6">
          <strong> Respuesta correcta: </strong>
          <img src="images/prueba.png" width="200">
        </div>
        <div class="col-6 offset-6">
          <span class="group-btn btn-group-justified ">
            <a href="#" class="btn btn-light btn-block"> Comenzar </a>
          </span>
          <br>
          <span class="group-btn btn-group-justified ">
            <a href="#" class="btn btn-light btn-block"> Volver </a>
          </span>
          <br>
          <span class="group-btn btn-group-justified ">
            <a href="#" class="btn btn-light btn-block"> Cancelar </a>
          </span>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

<?php require_once("footer.php"); ?>