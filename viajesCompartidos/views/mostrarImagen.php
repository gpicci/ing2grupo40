<?php $id =  $_GET['id'];
$link = mysqli_connect("localhost", "root", "", "viajes") or die("Error ".mysqli_error($link));
// se recupera la información de la imagen
//include("connection.php");
//$link =connect();
$sql2 ="SELECT foto FROM usuario WHERE usuario_id=$id";
$result = mysqli_query($link, $sql2);
$row = mysqli_fetch_array($result);
mysqli_close($link); 
/* se imprime la imagen y se le avisa al navegador que lo que se está
enviando no es texto, sino que es unaimagen un tipo en particular */
header("Content-type: image/png") ; 
echo $row['foto'];?>
