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

$question = $_POST["question"];
$rfid = $_POST["rfid"];
$activity = $_POST["activity"];

$types = $conexion->query("select g.type from genericActivity g inner join activity a on g.id = a.genericActivity where g.id = $activity");
$type = $types->fetch_array();
if ($type[0] == 0)
{
	$picts = $conexion->query("select pictogram from card where rfid = '" . $rfid . "'");
	if ($picts->num_rows == 0)
	{
		echo 3;
	}
	else
	{
		$pict = $picts->fetch_array();
		$correctas = $conexion->query("select pictogram from pictogramsQuestion where question = $question and info = 1");
		$correcta = $correctas->fetch_array();
		if ($correcta[0] == $pict[0])
		{
			$conexion->query("insert into answers (question, pictogram, correct, date, activity) values ($question, $pict[0], 1, NOW(), $activity)");
			echo 1;
		}
		else
		{
			$conexion->query("insert into answers (question, pictogram, correct, date, activity) values ($question, $pict[0], 0, NOW(), $activity)");
			echo 2;
		}
	}
}
else
{
}
$conexion->query("update activity set startTime = NOW(), comentary = '" . $com . "' where id = $activity");