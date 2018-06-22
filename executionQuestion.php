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
?>
<html>
<html>
  <head>
  <title>Student</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
          <?php
            $information = $conexion->query("select p.name, g.name, p.surname, g.id FROM activity a, genericActivity g, person p WHERE a.genericActivity = g.id and a.student = p.id and a.id = " . $_GET['activity']);
            $infor = $information->fetch_array();
          echo "<h2>Ejecución de actividad <b>$infor[1]</b> para el alumno <b>$infor[0] $infor[2]</b></h2>";

?>          
      <div class="col-md-8">
        <div class="form-group text-center">
          <br>
          <br>
		  <?php
		  $questions = $conexion->query("select id, description from questions where activity = $infor[3] and id not in (SELECT question from answers where activity = " . $_GET['activity'] . " and correct = 1) order by id Limit 0,1");
		  if ($questions->num_rows == 0)
		  {
			  echo "No hay preguntas sin responder";
		  }
		  else{
		  $question = $questions->fetch_array();
		  
		  echo "<h2>Pregunta: $question[1]</h2>";
		  ?>
          <br>
          <br>
		  <?php
		  
		  $pictograms = $conexion->query("select p.id, p.ext from pictogram p inner join pictogramsQuestion pq on pq.pictogram = p.id where pq.question = $question[0]");
		  echo "<p>";
		  while ($pictogram = $pictograms->fetch_array())
		  {
				echo "<img src='/pictograms/" . $pictogram[0] . "." . $pictogram[1] . "' width='150' />";
			  
		  }
		  ?>
		  </p>
		  <?php
		  }
		  ?>
          <br>
          <br>
          <br>
		  <input type="hidden" id="oculto" />
        </div>
      </div>
    </div>
  </div>

  
    <script>
$(document).keypress(function(e) {
	
    if(e.which == 13) {
	  var url = "executionQuestion.save.php";  
	  var id = <?php echo $question[0]; ?>;
	  var activity = <?php echo $_GET['activity']; ?>;
	  var rfid = $("#oculto").val();
	  var datos = {question: id, rfid:rfid, activity:activity};
	  $.post(url, datos, function(resultado) {
		if (resultado == 1)
		{
		  window.location.replace("executionQuestion.php?activity=" + <?php echo $_GET['activity']; ?>);
		}
		else if (resultado == 3)
		{
		  alert("La tarjeta RFID no está asignada");
		  $("#oculto").val('');
		}
		else
		{
		  alert("Respuesta incorrecta");
		  $("#oculto").val('');
		}
	  });
    }
	else
	{
		$("#oculto").val($("#oculto").val() + String.fromCharCode(e.which));
	}
});</script>

<?php require_once("footer.php"); ?>          

