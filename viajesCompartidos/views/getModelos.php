<?php
require_once("../config.php");
include_once("../db/db.php");
include_once("../db/vehiculoDB.php");
require_once("../common/combo.php");

//include_once("log.php");

  if(isset($_GET['marca_id'])){
  	$db = DB::singleton();

  	$rs = getModelosPorMarca($_GET['marca_id']);

    while ($row = $db->fetch_assoc($rs)) {
      print("obj.options[obj.options.length] = new Option('".$row["nombre_modelo"] ."','".$row["modelo_id"]."');\n");
    }
  }
?>