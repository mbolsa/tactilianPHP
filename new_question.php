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
  <title>New Question</title>
  
  
<?php require_once("header.php"); ?>

  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-6">
        <div class="form-group has-feedback">
          <form method="post" action="new_question.new.php" id="new_question">
            <h4 class="display-4"> Nueva pregunta </h4>
´            <label class="control-label"> Descripción </label>
            <input type="text" name="description" id="description"class="form-control input-sm chat-input" placeholder="Descripción" required>
			<input type="hidden" name="activity" value="<?php echo $_GET["id"]; ?>" />
            <input type="submit" class="btn btn-light btn-block" value="Guardar pregunta!">
             <input type="button" class="btn btn-light btn-block" value="No deseo añadir más preguntas a la actividad" onClick="window.location.replace('/activities.php')"> 
         </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  
  <script>
  $('#new_question').submit(function(event) {  
  event.preventDefault();  
  var url = $(this).attr('action');  
  var datos = $(this).serialize();  
  $.post(url, datos, function(resultado) {
		if (resultado != 0)
		{
			alert("La pregunta se ha añadido correctamente");
			window.location.replace("/add_questionPictogram.php?id="+resultado);
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

