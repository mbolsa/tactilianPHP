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

$pictogram = $_POST["pictogram"];
$rfid = $_POST["oculto"];

$comprs = $conexion->query("select pictogram from card where rfid = '". $rfid . "'");
if ($comprs->num_rows == 0)
{
$conexion->query("insert into card (pictogram, rfid) values ($pictogram, '$rfid')");
}
else
{
	$conexion->query("update card set pictogram = $pictogram where rfid = '" . $rfid . "'");
}
echo 1;