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

$description = $_POST["description"];
$activity = $_POST["activity"];
if ($description == "")
{
	echo 0;
}
else
{
		$conexion->query("insert into questions (description, activity) values ('$description', $activity)");

		echo $conexion->insert_id;
}