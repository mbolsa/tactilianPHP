<html>
  <head>
	<title>Student</title>
	
	
<?php require_once("header.php"); ?>



  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-3">
           <div class="text-center">
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/catalog" class="btn btn-outline-light btn-block"> Registrar pictograma </a>
            </span>
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/catalog" class="btn btn-light btn-block"> Catálogo </a>
            </span>
          </div>
     </div>
      <div class="col-md-3 offset-md-2">
        <div class="wrapper">
          <div class="text-center">
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/monitoring.php?student=<?php echo $_GET["id"]; ?>" class="btn btn-light btn-block"> Seguimiento </a>
            </span>
            <br>
            <br>
            <span class="group-btn btn-group-justified ">
              <a href="/choose_activity.php?student=<?php echo $_GET["id"]; ?>" class="btn btn-light btn-block"> Empezar nueva actividad </a>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once("footer.php"); ?>