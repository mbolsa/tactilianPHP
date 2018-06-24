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

$question = $_POST["question"];
$rfid = $_POST["rfid"];
$activity = $_POST["activity"];
$ord = $_POST["ord"];

$types = $conexion->query("select g.type from genericActivity g inner join activity a on g.id = a.genericActivity where g.id = $activity");
$type = $types->fetch_array();
	$picts = $conexion->query("select c.pictogram, p.ext from card c inner join pictogram p on c.pictogram = p.id where c.rfid = '" . $rfid . "'");
	if ($picts->num_rows == 0)
	{
		echo 3;
	}
	else
	{
		$pict = $picts->fetch_array();
		if ($ord == 1)
		{
			$conexion->query("insert into answers (question, pictogram, correct, date, activity) values ($question, null, 0, NOW(), $activity)");
			$id = $conexion->insert_id;
		}
		else
		{
			$answers = $conexion->query("select id from answers where question = $question and activity = $activity order by id desc");
			$ans = $answers->fetch_array();
			$id = $ans[0];
		}
		$conexion->query("insert into answersOrder(answer, pictogram, ord) values ($id, $pict[0], $ord)");
		echo $pict[0] . "." . $pict[1];
		
		
	}
$conexion->query("update activity set startTime = NOW(), comentary = '" . $com . "' where id = $activity");