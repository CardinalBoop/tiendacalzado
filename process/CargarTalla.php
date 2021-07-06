<?php
session_start(); 
include '../library/configServer.php';
include '../library/consulSQL.php';

$talla = $_POST["talla"];
$codigo = $_POST["CodigoProd"];

  header("Location: /tiendacalzado/infoProd.php?CodigoProd=2094&Numero=".$_POST['talla']);

?>