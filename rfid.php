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
  <title>Associate RFID</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-6">
        <div class="form-group has-feedback">
          <form method="post" action="new_question.new.php" id="new_rfid">
            <h4 class="display-4"> Asociar RFID </h4>
            <label class="control-label">Pictograma </label>
			<select class="form-control" name="pictogram">
			<?php
			$picts = $conexion->query("select id, name from pictogram");
			while ($pict = $picts->fetch_array())
			{
				echo "<option value='" . $pict[0] . "'>$pict[1]</option>";
			}
			?>
            </select></p>
			<p>Pase el RFID por el lector para asociarlo con el pictograma</p>
			<input type='hidden' name='oculto' id='oculto' />
			</form>
        </div>
      </div>
    </div>
  </div>
<script>


$(document).keypress(function(e) {
	
    if(e.which == 13) {
	  var url = "rfid.new.php";  
	  var datos = $("#new_rfid").serialize();
	  $.post(url, datos, function(resultado) {
		if (resultado == 1)
		{
			alert("Tarjeta RFID asociada");
		  window.location.replace("rfid.php");
		}
		else
		{
		  alert("Algo falla");
		  $("#oculto").val('');
		}
	  });
    }
	else
	{
		$("#oculto").val($("#oculto").val() + String.fromCharCode(e.which));
	}
});

</script>

<?php require_once("footer.php"); ?>          

