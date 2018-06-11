<?php

function escribePagina($error)
{
?>

<html>
<head>

<?php require_once("includes.php"); ?>
<link href="/css/index.css" rel="stylesheet">

</head>
<body>



<div class="container">
    <h1 class="welcome text-center">Welcome to <br> Tactilian</h1>
        <div class="card card-container">
        <h2 class='login_title text-center'>Login</h2>
        <hr>

            <form class="form-signin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title">Email</p>
                <input type="text" id="inputEmail" name="email" class="login_box" placeholder="Usuario" required autofocus>
                <p class="input_title">Password</p>
                <input type="password" id="inputPassword" name="password" class="login_box" placeholder="******" required>
				<?php if ($error == 1) echo "Datos de acceso incorrectos"; ?>
                <button class="btn btn-lg btn-primary" type="submit" name="botEnviar">Login</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
	
</body>
	
<?php
}

function ComprobarLogin($email, $password)
{
	global $conexion;
	$resultado = $conexion->query("SELECT password FROM person WHERE email = '$email'");
	if ($resultado->num_rows == 0)
	{
		return FALSE;
	}
	else
	{
		$fila = $resultado->fetch_array();
		$resultado->close();
		$crypt_pw = $fila[0];
		return ($crypt_pw == md5($password));
	}
}

function cargarDatosSesion($email)
{
	global $conexion;
	$resultado = $conexion->query("SELECT id, name, surname, type FROM person WHERE email = '$email'");
	$fila = $resultado->fetch_assoc();
	session_start();
	$_SESSION["user"] = $fila;
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


session_start();
if (isset($_SESSION["user"]))
{
	header ("location:home.php");
}
else
{
	if ($_POST["email"] == "")
	{	
		escribePagina(0);
	}
	else
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		if (ComprobarLogin($email, $password))
		{
			cargarDatosSesion($email);
			header ("location:home.php");
		}
		else
		{
			escribePagina(1);
		}
	}
}

?>