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
    <div class="row justify-content-center">
          <?php
            $information = $conexion->query("select p.name, g.name, p.surname, g.id, g.type FROM activity a, genericActivity g, person p WHERE a.genericActivity = g.id and a.student = p.id and a.id = " . $_GET['activity']);
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
		  $num = $pictograms->num_rows;
		  while ($pictogram = $pictograms->fetch_array())
		  {
				echo "<img src='/pictograms/" . $pictogram[0] . "." . $pictogram[1] . "' width='150' />";
			  
		  }
		  ?>
		  </p>
		  <?php
		  }
		  if ($infor[4] == 0)
		  {
		  ?>
		  <p><b>Tu respuesta:</b></p>
		  <div id="respuestaOrder">
		  <?php
		  for ($i=0;$i<$num;$i++)
		  {
			  echo "<input type='hidden' id='oculto" . $i . "' />";
		  }
		  
		  ?>
		  
		  </div>
		  <?php
		  }
		  else
		  {
			  ?>
		  
          <br>
          <br>
          <br>
		  <input type="hidden" id="oculto" />
			  <?php
		  }
		  ?>
        </div>
      </div>
    </div>
  </div>

  
    <script>
	<?php
	
	if ($infor[4] == 1)
	{
		?>
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
});

<?php

	}
	else
	{
		?>
	  var ord = 0;
$(document).keypress(function(e) {
	
    if(e.which == 13) {
	  var url = "executionQuestion.saveOrder.php";  
	  var id = <?php echo $question[0]; ?>;
	  var activity = <?php echo $_GET['activity']; ?>;
	  var rfid = $("#oculto" + ord).val();
	  ord++;
	  var datos = {question: id, rfid:rfid, activity:activity, ord:ord};
	  $.post(url, datos, function(resultado) {
		  alert(resultado);
		if (resultado == 3)
		{
		  alert("La tarjeta RFID no está asignada");
		  ord = ord -1;
		  $("#oculto" + ord).val('');
		}
		else
		{
			$("#respuestaOrder").append("<img src='/pictograms/" + resultado + "' width='150' />");
			$("#oculto" + ord).val('');
			if (ord == <?php echo $num; ?>)
			{
			  var url = "executionQuestion.check.php";  
			  var id = <?php echo $question[0]; ?>;
			  var activity = <?php echo $_GET['activity']; ?>;
			  var datos = {question: id, rfid:rfid, activity:activity, ord:ord};
			  $.post(url, datos, function(resultado) {
				  if (resultado == 1)
				  {
					  alert("Respuesta correcta");
					  window.location.replace("executionQuestion.php?activity=" + <?php echo $_GET['activity']; ?>);
				  }
				  else
				  {
					  alert("respuesta incorrecta");
					  window.location.replace("executionQuestion.php?activity=" + <?php echo $_GET['activity']; ?>);
					  
				  }					  
				  
				  
				  
			  });
			}
		}
	  });
    }
	else
	{
		$("#oculto" + ord).val($("#oculto" + ord).val() + String.fromCharCode(e.which));
	}
});

		
		
		
		<?php
	}
?>
</script>

<?php require_once("footer.php"); ?>          

