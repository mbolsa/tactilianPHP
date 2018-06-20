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

$name = $_POST["name"];
$description = $_POST["description"];
$type = $_POST["type"];
if (($name == "") OR ($description == "") OR ($type == ""))
{
	echo 0;
}
else
{
		$conexion->query("insert into genericActivity (name, type, description, autor) values ('$name', $type, '$description', " . $_SESSION["user"]["id"] . ")");
		// Mandar email
		echo $conexion->insert_id;
}