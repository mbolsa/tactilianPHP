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
		
		$pictograms = $conexion->query("select p.id, p.ext, p.name from pictogram p, assign a where a.pictogram = p.id");
		if ($pictograms->num_rows ==0)
		{
			echo "<p><b>No hay pictogramas asignados</b></p>";
		}
		else
		{
			while ($pic = $pictograms->fetch_array())
			{
        
  
				echo "<figure class='figure' style='background-color:#ffffff;'><img src='pictograms/" . $pic[0] . "." . $pic[1] . "' class='figure-img img-fluid rounded' width='200' height='200'><figcaption class='figure-caption text-center' style='background-color:#ffffff; color:#0A5794'>" . $pic[2] . "</figcaption></figure>";
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
        <div class="">
          <span class="group-btn btn-group-justified ">
            <a href="add_pictograms_student.php?student=<?php echo $_GET["student"]; ?>" class="btn btn-light btn-block"> Nuevo </a>
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