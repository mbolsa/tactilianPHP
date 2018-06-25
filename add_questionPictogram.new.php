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
$question = $_POST["question"];
$info = $_POST["info"];
	$conexion->query("insert into pictogramsQuestion (question, pictogram, info) values ($question, $pictogram, $info)");

		echo 1;
