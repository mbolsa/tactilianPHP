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
	<title>Student</title>
	
	
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
    	<div class="col-md-5">
        <div class="form-group has-feedback">
          <form method="post" action="" id="form">
          	<?php
            $id = $_GET['id'];
          	$infos = $conexion->query("select name, surname, alias, id from person where id = " . $_GET["id"]);
          	$info = $infos->fetch_array();

          	$type = $conexion->query("select type FROM person WHERE id = " . $_SESSION["user"]["id"]);
            $t = $type->fetch_array();
          	?>
          	<h2> Información del estudiante </h2>
            <input type="hidden" id="pid" name="personid" value="<?php echo $id; ?>">
            <label class="control-label"> Nombre </label>
            <input type="text" name="name" id="nombre" pattern="^.{1,19}$" title="Entre 1 y 20 letras y/o espacios" class="form-control input-sm chat-input", placeholder="Nombre" value="<?php echo $info[0] ?>">
            <br>
            <label class="control-label"> Apellidos </label>
            <input type="text" name="surname" id="apellido" pattern="^.{1,19}$" title="Entre 1 y 20 letras y/o espacios" class="form-control input-sm chat-input", placeholder="Apellidos" value="<?php echo $info[1] ?>">
            <br>
            <label class="control-label"> Alias </label>
            <input type="text" name="nick" id="alias" pattern="^.{0,20}$" title="Entre 0 y 20 letras y/o espacios"  class="form-control input-sm chat-input" placeholder="Alias" value="<?php echo $info[2] ?>">
            <br>
            <?php
            if ($t[0] == 3) {
            ?>
            <input type="button" class="btn btn-light btn-block" name="actualizar" id="update" value="Actualizar" onClick="actualiza();"> 
            <br>
            <input type="button" class="btn btn-outline-light btn-block" name="borrar" id="delete" value="Borrar" onClick="borrar();"> 
            <?php } ?>
          </form>
      	</div>
      </div>
      <div class="col-md-4 offset-md-2">
        <div class="text-center">
          <br>
          <br>
          <br>
          <br>
          <span class="group-btn btn-group-justified ">
            <a href="/monitoring.php?student=<?php echo $_GET["id"]; ?>" class="btn btn-light btn-block"> Seguimiento </a>
          </span>
          <br>
          <span class="group-btn btn-group-justified ">
            <a href="/pictograms_student.php?student=<?php echo $_GET["id"]; ?>" class="btn btn-light btn-block"> Catálogo </a>
          </span>
          <br>
          <span class="group-btn btn-group-justified ">
            <a href="/choose_activity.php?student=<?php echo $_GET["id"]; ?>" class="btn btn-light btn-block"> Empezar nueva actividad </a>
          </span>
        </div>
      </div>
    </div>
  </div>

<script>
function actualiza()
{        var url = "student.update.php"; 
        var datos = $("#form").serialize();   
        $.post(url, datos, function(resultado) {
          if (resultado == 1)
          {
            alert("Información actualizada");
            window.location.replace("student.php?id=" + <?php echo $id; ?>);
          }
          else if (resultado == 2)
          {
            alert("Rellene todos los datos");
          }
          else
          {
            alert("ERROR");
          }
        });
      }
      
function borrar()
{
	var url = "student.delete.php"; 
        var datos = $(this).serialize();   
        $.post(url, datos, function(resultado) {
          if (resultado == 1)
          {
            alert("El alumno se ha borrado correctamente");
            window.location.replace("home.php");
          }
          else
          {
            alert("ERROR");
          }
        });
  }
 </script>

<?php require_once("footer.php"); ?>