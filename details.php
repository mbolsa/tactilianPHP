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

?>
<html>
<html>
  <head>
  <title>Student</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center col-12">
          <?php
            $information = $conexion->query("select p.name, g.name, p.surname, a.startTime, a.endTime, a.comentary, g.id, a.id, g.type FROM activity a, genericActivity g, person p WHERE a.genericActivity = g.id and a.student = p.id and a.id = " . $_GET['id']);
            $infor = $information->fetch_array();
          echo "<h2> Información de actividad <b>$infor[1]</b></h2>";

?>          
</div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="form-group text-center">
          <br>
          <br>
          <br>
          <br>
          <div class="form-group text-center">
            <h4> Comentarios </h4>
          </div>
          <p><?php echo $infor[5]; ?>
        </div>
      </div>
      <div class="offset-md-2 col-md-5">
        <br>
        <br>
        <br>
        <div class="form-group text-center">
          <h4> Información </h4>
        </div>
        <div class="form-control">
          <p> Hora de Inicio:       <?php echo date_format(date_create($infor[3]), "d/m/Y H:i"); ?> </p>
          <p> Hora de Fin:          <?php echo date_format(date_create($infor[4]), "d/m/Y H:i"); ?> </p>
          <p> Alumno:               <?php echo $infor[0]; ?> </p>
          <p> Profesor:             <?php echo $infor[2]; ?> </p>
          <p> Tipo:            		 <?php if ($infor[8] == 1) echo "Seleccionar respuesta"; else echo "Ordenar"; ?> </p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
	<div class="col-12">
<h2 style="text-align:center">Respuestas</h2>
</div>
<div class="offset-md-2 col-md-8">
<?php 
$questions = $conexion->query("select id, description from questions where activity = $infor[6]");
while ($question = $questions->fetch_array())
{
	echo "<h4>$question[1]</h4>";
	if ($infor[8] == 1)
	{
		$i = 1;
		$answers = $conexion->query("select a.id, a.pictogram, a.correct, a.date, p.ext from answers a inner join pictogram p on p.id = a.pictogram where a.question = $question[0] and a.activity = $infor[7]");	
		while ($answer = $answers->fetch_array())
		{
			echo "<p>Intento $i - " . date_format(date_create($answer[3]), "d/m/Y H:i") . "</p>"; 
			echo "<p><img src='/pictograms/" . $answer[1] . "." . $answer[4] . "' width='150' />";
			if ($answer[2] == 1)
			{
				echo "<b>Respuesta correcta</b>";
			}
			else
			{
				echo "<b>Respuesta incorrecta</b>";
			}
			echo "</p>";
			$i++;
		}
	}
	else 
	{
		$i = 1;
		$answers = $conexion->query("select a.id, a.pictogram, a.correct, a.date, p.ext from answers a inner join pictogram p on p.id = a.pictogram where a.question = $question[0] and a.activity = $infor[7]");	
		while ($answer = $answers->fetch_array())
		{
			echo "<p>Intento $i - " . date_format(date_create($answer[3]), "d/m/Y H:i") . ". Orden:</p>";
			$orders = $conexion->query("select a.pictogram, p.ext from answersOrder a inner join pictogram p on a.pictogram = p.id where a.answer = $answer[0] order by a.ord asc");
			echo "<p>";
			while ($order = $orders->fetch_array())
			{
				echo "<img src='/pictograms/" . $order[0] . "." . $order[1] . "' width='150' />";
				
			}
			echo "</p>";
			if ($answer[2] == 1)
			{
				echo "<b>Respuesta correcta</b>";
			}
			else
			{
				echo "<b>Respuesta incorrecta</b>";
			}
			echo "</p>";
			$i++;
		}
	}
	echo "<br><br>";
	
}
?>
</div>
</div>
	</div>

<?php require_once("footer.php"); ?>          

