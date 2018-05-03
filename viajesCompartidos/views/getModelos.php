<?php
  require_once("config.php");
  include_once("db.php");
  include_once("log.php");
  
  if(isset($_GET['idMarca'])){
  
  	$rs = getModelosPorMarca($_GET['idMarca']);
    
    $db = DB::singleton();

    while ($row = $db->fetch_assoc($rs)) {
      print("obj.options[obj.options.length] = new Option('".$row["nombre_modelo"] ."','".$row["modelo_id"]."');\n");
    }
  }
?>