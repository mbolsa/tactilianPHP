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
$email = $_POST["email"];
$type = $_POST["type"];

if (($name == "") OR ($surname == "") OR ($email == ""))
{
	echo 2;
}
else
{
	$comprs = $conexion->query("SELECT id FROM person WHERE email = '$email'");
	if ($comprs->num_rows != 0)
	{
		echo 3;
	}
	else
	{
		$temp = md5(time());
		$pass = substr(0,8, $temp);
		$passcrypt = md5($pass);
		$conexion->query("insert into person (name, surname, email, alias, passwd, type) values ('$name', '$surname', '$email', '$alias', '$passcrypt', '$type')");
		// Mandar email
		echo 1;
	}
}