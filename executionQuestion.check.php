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
$activity = $_POST["activity"];
$error = false;
			$answers = $conexion->query("select id from answers where question = $question and activity = $activity order by id desc");
			$ans = $answers->fetch_array();
			
			
			$answersOrders = $conexion->query("select pictogram, ord from answersOrder where answer = $ans[0]");
			while ($answersOrder = $answersOrders->fetch_array())
			{
				$comprs = $conexion->query("select pictogram from pictogramsQuestion where question = $question and info = $answersOrder[1] and pictogram = $answersOrder[0]");
				if ($comprs->num_rows == 0)
				{
					$error = true;
				}
			}
if ($error)
{
	echo 0;
}
else
{
	$conexion->query("update answers set correct = 1  where id = $ans[0]");
	$conexion->query("update activity set endTime = NOW(),  where id = $activity");
	echo 1;
}