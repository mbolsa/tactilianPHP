<?php

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

<?php require_once("includes.php"); ?>

</head>
<body>



<div class="col-md-12 text-center">

        <div id="login-wraper">
                <form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="acceso">
                <input type="hidden" name="p" value="<?php
		if (empty($_GET["p"]))
		{
			if (!empty($_POST["p"]))
			{
				echo $_POST["p"];
			}
		}
		else
		{
			echo $_GET["p"];
		}
		?>" />
        <input type="hidden" name="id" value="<?php
		if (empty($_GET["id"]))
		{
			if (!empty($_POST["id"]))
			{
				echo $_POST["id"];
			}
		}
		else
		{
			echo $_GET["id"];
		}
		global $sub;
		?>" />
        <input type="hidden" id="oculto" name="oculto" value="0" />
        		<legend style="padding-bottom:15px;"><img src="https://xavierre.aularium.es/img/<?php $sub = "xavierre"; echo $sub; ?>.png" width="58" /></legend>
            
                <div class="body">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Usuario </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" required name="email" id="username" placeholder="Usuario">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Contraseña</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" required name="password" id="password" placeholder="Contraseña">
                        </div>
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="text-right col-xs-5 col-sm-6" style="margin-top:15px;">
                          <button type="button" class="btn btn-danger olvidar">Olvidé mi contraseña</button>
                          </div>
                        <div class="text-left col-xs-5 col-sm-6 col-xs-offset-2 col-sm-offset-0" style="margin-top:15px;">
                          <input type="submit" class="btn btn-success" id="botEnviar" name="botEnviar" value="Acceder"></input>
                        </div>
                      </div>
                </div>
            
            
            </form>
        </div>

</div>

	