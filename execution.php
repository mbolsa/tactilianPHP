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
            $information = $conexion->query("select p.name, g.name, p.surname FROM activity a, genericActivity g, person p WHERE a.genericActivity = g.id and a.student = p.id and a.id = " . $_GET['activity']);
            $infor = $information->fetch_array();
          echo "<h2> Ejecución de actividad <b>$infor[1]</b> para el alumno <b>$infor[0] $infor[2]</b></h2>";

?>          
      <div class="col-md-8">
        <div class="form-group text-center">
          <br>
          <br>
          <span class="group-btn btn-group-justified">
            <a href="#" class="btn btn-light btn-block" onClick="empezar();"> Iniciar </a>
          </span>
          <br>
          <br>
          <br>
          <br>
          <br>
          <div class="form-group text-center">
            <h4> Comentarios </h4>
          </div>
          <textarea class="form-control" placeholder="escriba comentarios aquí" id="comentary" name="description", rows = "5"></textarea>
        </div>
      </div>
    </div>
  </div>

  
    <script>
  function empezar() {  
  var url = "execution.start.php";  
  var id = <?php echo $_GET["activity"]; ?>;
  var comentary = $("#comentary").val();
  var datos = {activity: id, com:comentary};
  $.post(url, datos, function(resultado) {
    
    if (resultado != 0)
    {
      window.location.replace("executionQuestion.php?activity=" + id);
    }
    else
    {
      alert("ERROR");
    }
  });
}
</script>

<?php require_once("footer.php"); ?>          

