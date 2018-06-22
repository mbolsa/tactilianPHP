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
if ($name == "")
{
	echo 0;
}
else
{
		$ext = pathinfo(basename($_FILES['pic']['name']), PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		$uploaddir = 'pictograms/';
		$sql = "insert into pictogram (name, ext) values ('" . $name . "', '" . $ext . "')";
		$conexion->query($sql);
		$Id = $conexion->insert_id;
		$uploadfile = $uploaddir . $Id . "." . $ext;
		move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile);


		// Mandar email
		header("location:/pictograms.php");
}