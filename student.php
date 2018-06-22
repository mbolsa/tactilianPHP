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
	<title>Student</title>
	
	
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
	<div class="col-md-12">
	<h2>
	<?php
	$infos = $conexion->query("select name, surname from person where id = " . $_GET["id"]);
	$info = $infos->fetch_array();
	echo $info[0] . " " . $info[1];
	
	?>
	</h2>
	</div>
      <div class="col-md-3">
           <div class="text-center">
            <br>
            <br>
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/monitoring.php?student=<?php echo $_GET["id"]; ?>" class="btn btn-light btn-block"> Seguimiento </a>
            </span>
          </div>
     </div>
      <div class="col-md-3 offset-md-2">
        <div class="wrapper">
          <div class="text-center">
            <br>
            <br>
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/choose_activity.php?student=<?php echo $_GET["id"]; ?>" class="btn btn-light btn-block"> Empezar nueva actividad </a>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once("footer.php"); ?>