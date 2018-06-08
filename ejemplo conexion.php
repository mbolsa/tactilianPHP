<?php

require_once("conexion.inc.php");
$conexion = new mysqli($servidor, $usuario, $passwd, $basedatos);
if (mysqli_connect_errno())
{
	echo "Error al establecer la conexión con la base de datos: " . mysqli_connect_error();
	exit();
}
$conexion->query("set names utf8");


$alumnos = $conexion->query("select id, nombre, apellidos from alumnos order by apellidos");

if ($alumnos->num_rows == 0)
{
	echo "No hay alumnos";
}
else
{
	?>
	<table>
	<tr><td>Nombre</td><td>Apellidos</td></tr>
	<?php
	while ($alumno = $alumnos->fetch_array())
	{
		echo "<tr><td>$alumno[1]</td><td>$alumno[2]</td></tr>";
	}
	echo "</table>";
}


?>