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
          <form method="post" action="new_activity.new.php" id="new_activity">
            <h4 class="display-4"> Nueva actividad </h4>
            <label class="control-label"> Nombre </label>
            <input type="text" name="name" id="name" class="form-control input-sm chat-input", placeholder="Nombre" required>
            <br>
            <label class="control-label"> Descripción </label>
            <input type="text" name="description" id="description"class="form-control input-sm chat-input" placeholder="Descripción" required>
            <br>
            <select class="form-control" name="type">
              <option value="0">Ordenar pictogramas</option>
              <option value="1">Elegir opción correcta</option>
            </select>
            <br>
            <input type="submit" class="btn btn-light btn-block" value="Crear actividad!"> 
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  
  <script>
  $('#new_activity').submit(function(event) {  
  event.preventDefault();  
  var url = $(this).attr('action');  
  var datos = $(this).serialize();  
  $.post(url, datos, function(resultado) {
		if (resultado != 0)
		{
			alert("La actividad se ha añadido correctamente");
			window.location.replace("/add_question.php?id="+resultado);
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

