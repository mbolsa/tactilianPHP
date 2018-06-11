<?php

require_once("conexion.inc.php");
$conexion = new mysqli($servidor, $usuario, $passwd, $basedatos);
if (mysqli_connect_errno())
{
  echo "Error al establecer la conexión con la base de datos: " . mysqli_connect_error();
  exit();
}
$conexion->query("set names utf8");

$passwd = $_POST["current_passwd"];
$newPasswd = $_POST["new_passwd"];
$newPasswdRepeat = $_POST["new_passwd_repeat"];

if (($passwd == "") OR ($newPasswd == "") OR ($newPasswdRepeat == ""))
{
  echo 2;
}
else
{
  $resultado = $conexion->query("select passwd from person where id = " . $_SESSION["user"]["id"]);
  $fila = $resultado->fetch_array();
  $resultado->close();
  $crypt_pw = $fila[0];
  if ($crypt_pw == md5($passwd)) {
    if ($newPasswd == $newPasswdRepeat) {
      $passcrypt = md5($newPasswd);
      $conexion->query("update person set passwd = '$passcrypt' where id = " . $_SESSION["user"]["id"]);
      echo 1;
    }
    else {
      echo 3;
    }
  }
  else {
    echo 4;
  }
}