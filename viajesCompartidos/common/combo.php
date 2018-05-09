<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/viajes/db/db.php");

  function comboBox(
    $formFieldName,
  	$resultSet,
  	$keyFieldName,
  	$listFieldName,
  	$defaultDescription,
  	$selectedKey,
  	$additionalData,
  	$defaultSelectKey=-1) {

  	$db = DB::singleton();

    echo "<select style=\"font-size:12px;font-family:arial;\" id=\"$formFieldName\" onClick=\"this.select()\" name=\"$formFieldName\" $additionalData>";

   	$showDefault = true;

  	while ($row = $db->fetch_assoc($resultSet)) {
      if ($row[$keyFieldName]==$selectedKey) {
        $selected = "selected";
        $showDefault = false;
      } else {
        $selected = "";
      }

      echo "<OPTION value=".$row[$keyFieldName]." $selected >".$row[$listFieldName]."</OPTION>";
   	};

  	//si no hay una opcion por defecto
    //if (isSet($defaultDescription) and ($defaultDescription<>"") and ($showDefault)) {

    //modifico para que siempre muestra la defaultDescription pero que la seleccione
    //solo si no encuentra $selectedKey en el resultSet
    if (isSet($defaultDescription) and ($defaultDescription<>"") ) {
  	  if ($showDefault) {
        echo "<OPTION value=$defaultSelectKey selected >$defaultDescription</OPTION>";
      } else {
        echo "<OPTION value=$defaultSelectKey >$defaultDescription</OPTION>";
      }
    };

    echo "</select>";

  }

  function comboBox2(
  		$formFieldName,
  		$resultSet,
  		$keyFieldName,
  		$listFieldName,
  		$defaultDescription,
  		$selectedKey,
  		$additionalData,
  		$defaultSelectKey=-1) {

  			$db = DB::singleton();

  			echo "<select style=\"font-size:12px;font-family:arial;\" id=\"$formFieldName\" name=\"$formFieldName\" $additionalData>";

  			$showDefault = true;

  			while ($row = $db->fetch_assoc($resultSet)) {
  				if ($row[$keyFieldName]==$selectedKey) {
  					$selected = "selected";
  					$showDefault = false;
  				} else {
  					$selected = "";
  				}

  				echo "<OPTION value=".$row[$keyFieldName]." $selected >".$row[$listFieldName]."</OPTION>";
  			};

  			//si no hay una opcion por defecto
  			//if (isSet($defaultDescription) and ($defaultDescription<>"") and ($showDefault)) {

  			//modifico para que siempre muestra la defaultDescription pero que la seleccione
  			//solo si no encuentra $selectedKey en el resultSet
  			if (isSet($defaultDescription) and ($defaultDescription<>"") ) {
  				if ($showDefault) {
  					echo "<OPTION value=$defaultSelectKey selected >$defaultDescription</OPTION>";
  				} else {
  					echo "<OPTION value=$defaultSelectKey >$defaultDescription</OPTION>";
  				}
  			};

  			echo "</select>";

  }

  function radioGroup(
    $radioGroupName,
  	$resultSet,
  	$keyFieldName,
  	$listFieldName,
  	$selectedKey ) {

  	$db = DB::singleton();

    while ($row = $db->fetch_assoc($resultSet)) {
      if ($row[$keyFieldName]==$selectedKey) {
        $checked = "checked";
      } else {
        $checked = "";
      };

      echo "<input type=\"radio\" name=\"$radioGroupName\" value=\"".$row[$keyFieldName]."\" $checked>".$row[$listFieldName]."</input>";
    };
  }

  function linkedText(
    $formFieldName,
  	$resultSet,
  	$keyFieldName,
  	$listFieldName,
  	$defaultDescription,
  	$selectedKey,
  	$additionalData) {

  	$db = DB::singleton();

	$showDefault = true;

	while ($row = $db->fetch_assoc($resultSet)) {
	  if ($row[$keyFieldName]==$selectedKey) {
		echo "<INPUT id=\"$formFieldName"."_linkedText\" name=\"$formFieldName"."_linkedText\" $additionalData";
		echo " value=\"".$row[$listFieldName]."\" readonly=\"readonly\">";
		echo "<INPUT type=\"HIDDEN\" id=\"$formFieldName\" name=\"$formFieldName\" value=\"".$row[$keyFieldName]."\">";
	  }
	};
  }



?>