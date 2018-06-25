<?php

session_start();
if (!isset($_SESSION["user"]))
{
  header("location:index.php");
}

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
  <head>
  <title>New Activity</title>
  
  
<?php require_once("header.php"); ?>

  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-6">
        <div class="form-group has-feedback">
          <form method="post" action="add_questionPictogram.new.php" id="new_pictogram">
            <h4 class="display-4"> Añadir pictograma </h4>
 <p><b>Pictograma:</b><select class="form-control" name="pictogram">
			<?php
			$infor = $conexion->query("select g.type from genericActivity g inner join questions q on g.id = q.activity where q.id = " . $_GET["id"]);
			$info = $infor->fetch_array();
			$picts = $conexion->query("select id, name from pictogram");
			while ($pict = $picts->fetch_array())
			{
				echo "<option value='" . $pict[0] . "'>$pict[1]</option>";
			}
			?>
            </select></p>
			<?php
			if ($info[0] == 1)
			{
				?>
            <p><b>Respuesta:</b><select class="form-control" name="info">
				<option value='0'>Respuesta incorrecta</option>
				<option value='1'>Respuesta correcta</option>
            </select></p>
			<?php
			
			}
			else
			{
				echo "<input type='hidden' value'";
				$ords = $conexion->query("select info from pictogramsQuestion where question = " . $_GET["id"] . " order by info desc");
				if ($ords->num_rows == 0)
				{
					echo 1;
				}
				else
				{
					$ord = $ords->fetch_array();
					echo $ord[0];
				}
			}
			?>


			<input type="hidden" name="question" value="<?php echo $_GET["id"]; ?>" />
            <input type="submit" class="btn btn-light btn-block" value="Añadir pictograma!"> 
            <input type="button" class="btn btn-light btn-block" value="No deseo añadir más pictogramas a la pregunta" onClick="window.location.replace('/new_question.php?id=<?php echo $_GET["id"]; ?>');"> 
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  
  <script>
  $('#new_pictogram').submit(function(event) {  
  event.preventDefault();  
  var url = $(this).attr('action');  
  var datos = $(this).serialize();  
  $.post(url, datos, function(resultado) {
		if (resultado == 1)
		{
			alert("El pictograma se ha añadido a la pregunta");
			window.location.replace("/add_questionPictogram.php?id="+<?php echo $_GET["id"]; ?>);
		}
		else
		{
			alert("ERROR");
		}
	});
}); 

</script>
  <?php require_once("footer.php"); ?>

<?php

