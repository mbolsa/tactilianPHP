<?php

session_start();
if (!isset($_SESSION["user"]))
{
  header("location:index.php");
}

?>
<html>
  <head>
  <title>Teacher Home</title>
  
  
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-2 col-md-3">
        <h1><a href="students.php">Lista de alumnos</a></h1>
      </div>
      <div class="col-md-offset-2 col-md-3">
        <h1><a href="activities.php">Lista de actividades</a></h1>
      </div>
    </div>
  </div>

  <br>
  <br>

  <?php require_once("footer.php"); ?>