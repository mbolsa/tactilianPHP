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
  <head>
	<title>Choose Activity</title>
	
	
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="form-group">
          <h2> Seleccione Actividad </h2>
		  <?php
		  $id = $_GET['student'];
		  $activities = $conexion->query("select id, name from genericActivity;");
		  if ($activities->num_rows == 0)
		  {
			  echo "<p><b>No hay actividades creadas</b></p>";
		  }
		  else
		  {
        ?>
			  <select class="form-control" size="10"  id="chooser">
        <?php
			  while ($activity = $activities->fetch_array())
			  {
				  echo "<option value='" . $activity[0] . "'>$activity[1]</option>";
			  }
			  echo "</select>";
		  }
		  ?>
        </div>
        <br>
      </div>
          
      <div class="col-md-2"></div>
      <div class="col-md-4">
        <br>
        <br>
        <br>
        <div class="wrapper">
          <div class="text-center">
            <span class="group-btn btn-group-justified ">
              <a href="#" id="choose_activity" class="btn btn-light btn-block" onClick="guardar();"> Iniciar </a>
            </span>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>
  <br>
  <br>
  <script>
  function guardar() {  
  var url = "choose_activity.save.php";  
  var id = <?php echo $id; ?>;
  var val = $("#chooser").val();
  var datos = {student: id, activity: val};
  $.post(url, datos, function(resultado) {
    
    if (resultado != 0)
    {
      window.location.replace("execution.php?activity=" + resultado);
    }
    else
    {
      alert("ERROR");
    }
  });
}
</script>
 

<?php require_once("footer.php"); ?>