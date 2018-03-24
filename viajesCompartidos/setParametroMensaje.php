<?php	
require_once('db/parametrosSistemaDB.php'); 

	if (isset($_POST['cambiar'])) {
		setHoraInicioMantenimiento($_REQUEST['d_hora_inicio']);
		setHoraFinMantenimiento($_REQUEST['d_hora_fin']);
	}

?>
<form name='formSetear' id='formSetear' method='post' action="<?php print($_SERVER['PHP_SELF']); ?>">
	<div id="content">
		<div id="right" style="display: block; height: 400px; overflow: auto;">
		<div>
		  <label for="d_nombre">Hora Inicio <em>*</em></label>
		  <input id="d_hora_inicio" type="text" size="2" maxlength="2" name="d_hora_inicio" value="0" /></div>
	<br><br>		
	<div>
		  <label for="d_nombre">Hora Fin <em>*</em></label>
		  <input id="d_hora_fin" type="text" size="2" maxlength="2" name="d_hora_fin" value="0" /></div>
	<br><br>	
			<div class="buttonrow">
	  <input type="submit" name="cambiar" value="Cambiar" >
	</div>
	</div>
	</div>
		</form>
</body>