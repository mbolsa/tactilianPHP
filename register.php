<?php

function escribePagina($error)
{
?>

<html>
  <head>
  <title>Register</title>
  
  
<?php require_once("header.php"); ?>

  <br>
  <br>
  <div class="container main-container">
    <div class="row justify-content-center">
      <div class="col-md-offset-5 col-md-6">
        <div class="form-group has-feedback">
          <form method="post" action="">
            <h4 class="display-4"> Registro </h4>
            <label class="control-label"> Nombre </label>
            <input type="text" name="name" id="nombre" pattern="^.{1,19}$" title="Entre 1 y 20 letras y/o espacios" class="form-control input-sm chat-input", placeholder="Nombre" required>
            <br>
            <label class="control-label"> Apellido </label>
            <input type="text" name="surname" id="apellido" pattern="^.{1,19}$" title="Entre 1 y 20 letras y/o espacios" class="form-control input-sm chat-input" placeholder="Apellido" required>
            <br>
            <label class="control-label"> Alias </label>
            <input type="text" name="nick" id="alias" pattern="^.{1,19}$" title="Entre 1 y 20 letras y/o espacios" class="form-control input-sm chat-input" placeholder="Alias">
            <br>
            <label class="control-label"> Email </label>
            <input type="email" name="email" id="correo" pattern="^[a-z0-9._%+-]{1,37}@[a-z0-9.-]{1,20}\.[a-z]{2,3}$" class="form-control input-sm chat-input" placeholder="Email" required>
            <br>
            <select name="type">
              <option value="alumno">Alumno</option>
              <option value="profesor">Profesor</option>
            </select>
            <br>
            <?php if ($error == 1) echo "Email en uso"; ?>
            <input type="submit" class="btn btn-light btn-block" value="Crear usuario!"> 
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <?php require_once("footer.php"); ?>

<?php
}

function comprobarUser($email)
{
	global $conexion;
	$resultado = $conexion->query("SELECT name FROM person WHERE email = '$email'");
	if ($resultado->num_rows == 0)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function generateRandomString($length = 10) {

return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

}

function insertarDatos($email, $name, $surname, $nick, $type)
{
	global $conexion;
	$password1 = generateRandomString();
	$password = md5($password1);
	$resultado = $conexion->query("INSERT INTO person(email, name, surname, alias, type, passwd) VALUES ('$email', '$name', '$surname', '$nick', '$type', '$password')");
	if (mysqli_query($conexion, $resultado)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $resultado . "<br>" . mysqli_error($conexion);
	}
/*  $para      = $email;
  $titulo    = 'Credenciales Tactilian';
  $mensaje   = 'Hola,'. "\n"
                'Ha sido registrado satisfactoriamente en nuestra aplicación. Sus credenciales son las siguientes:' . "\n\t" .
                'email: ' . $email . "\n\t" .
                'contraseña: ' . $password1 . "\n" . 
                'Un saludo y gracias por registrarse.';
  $cabeceras = 'From: admin@tactilian.com';

  mail($para, $titulo, $mensaje, $cabeceras);*/
	$resultado->close();
}

require_once("conexion.inc.php");
$conexion = new mysqli($servidor, $usuario, $passwd, $basedatos);
if (mysqli_connect_errno())
{
	echo "Error al establecer la conexión con la base de datos: " . mysqli_connect_error();
	exit();
}

$conexion->query("set names utf8");

$email = $_POST["email"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$nick = $_POST["nick"];
$type = $_POST["type"];
if (comprobarUser($email)) {
	insertarDatos($email, $name, $surname, $nick, $type);
	header ("location:home.php");
}
else {
	escribePagina(1);
}