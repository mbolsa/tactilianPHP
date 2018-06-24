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


$name = $_POST["name"];
$surname = $_POST["surname"];
$nick = $_POST["nick"];
$id = $_POST["personid"];
if (($name == "") OR ($surname == ""))
{
  echo 2;
}
else
{
  $conexion->query("update person set name = '" . $name . "' , surname = '" . $surname . "', alias = '" . $nick . "' where id = $id");
  echo 1;
}