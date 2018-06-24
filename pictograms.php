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
	<title>Pictograms</title>
	
	
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <div class="form-group has-feedback">
          <?php
          echo "<h2> Pictogramas</b></h2>";
          ?>
        </div>
      </div>
      <div class="col-md-8 offset-md-1">
        <h4> Lista de pictogramas</h4>
        <div style="height:300px;overflow:auto;border:1px solid black;">
		<?php
		
		$pictograms = $conexion->query("select id, ext from pictogram");
		if ($pictograms->num_rows ==0)
		{
			echo "<p><b>No hay pictogramas</b></p>";
		}
		else
		{
			while ($pic = $pictograms->fetch_array())
			{
				echo "<img src='pictograms/" . $pic[0] . "." . $pic[1] . "' width='200' height='200'>";
			}
		}
		
		?>
        </div>
        <br>
      </div>
      <div class="col-md-2 offset-md-1 wrapper">
        <div class="">
          <span class="group-btn btn-group-justified ">
            <a href="new_pictogram.php" class="btn btn-light btn-block"> Nuevo </a>
          </span>
          <br>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

<?php require_once("footer.php"); ?>