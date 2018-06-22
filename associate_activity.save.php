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

$student = $_POST["student"];
$activity = $_POST["activity"];
$conexion->query("insert into activity (genericActivity, student, teacher) values ($activity, $student, " . $_SESSION["user"]["id"] . ")");
echo $conexion->insert_id;