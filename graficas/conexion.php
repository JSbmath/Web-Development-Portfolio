<?php
function conectar(){
  $user="root";
  $pass="";
  $server="localhost";
  $db="world";
  $con=mysqli_connect($server,$user,"",$db) or die ("Error en la conexion");
  return $con;
}
 ?>
