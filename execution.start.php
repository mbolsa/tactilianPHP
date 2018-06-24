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

$activity = $_POST["activity"];
$com = $_POST["com"];
$conexion->query("update activity set startTime = NOW(), comentary = '" . $com . "' where id = $activity");
echo 1;