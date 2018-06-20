<?php

session_start();
if (!isset($_SESSION["user"]))
{
	header("location:index.php");
}

?>

<html>
  <head>
  <title>New Pictogram</title>
  
  
<?php require_once("header.php"); ?>

  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-6">
        <div class="form-group has-feedback">
          <form method="post" action="new_pictogram.new.php" id="new_pictogram" enctype="multipart/form-data">
            <h4 class="display-4"> Nuevo pictograma </h4>
            <label class="control-label"> Nombre </label>
            <input type="text" name="name" id="name" class="form-control input-sm chat-input", placeholder="Nombre" required>
            <br>
			<label for="customFile">Choose file</label>   
			<input type="file" id="customFile" name="pic">
            <input type="submit" class="btn btn-light btn-block" value="Crear pictograma!" id="enviaboton"> 
		  </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  
  <script>
  
  $('#enviaboton').click(function() {
  $('#new_pictogram').submit();
});

var options = {
	success: function(responseText, statusText, xhr, $form) {
		if (responseText == 1)
		{
			alert("Pictograma añadido correctamente");
			window.location.replace("/pictograms.php");
		}
		else
		{
			alert("ERROR");
		}
	}
	
}
$('#new_pictogram').ajaxForm(options);

  
  
  

</script>
  <?php require_once("footer.php"); ?>

<?php

