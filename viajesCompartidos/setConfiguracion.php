<?php	
require_once('db/parametrosSistemaDB.php'); 

	if (isset($_POST['cambiarMensaje'])) {
		setHoraInicioMantenimiento($_REQUEST['d_hora_inicio']);
		setHoraFinMantenimiento($_REQUEST['d_hora_fin']);
		
		header('Location: main.php?accion=setConfiguracion');
	}

	if (isset($_POST['cambiarMail'])) {
		setUsuarioMail($_POST['usuario_mail']);
		setPassMail($_POST['pass_mail']);
		setHostMail($_POST['host_mail']);
		setPortMail($_POST['port_mail']);
		setFromMail($_POST['from_mail']);
		setNombreFromMail($_POST['nombre_from']);
		
		header('Location: main.php?accion=setConfiguracion');
	}	
	
	if (isset($_POST['cambiarCargo'])) {
		setCargoExtraHabilitado($_POST['d_cargo_e_habilitado']);
	
		header('Location: main.php?accion=setConfiguracion');
	}	

  $hora_inicio=getHoraInicioMantenimiento();	
  $hora_fin=getHoraFinMantenimiento();
  $usuario_mail=getUsuarioMail();
  $pass_mail=getPassMail();
  $host_mail=getHostMail();
  $port_mail=getPortMail();
  $from_mail=getFromMail();
  $nombre_from=getNombreFromMail();
  $cargoExtraHabilitado=getCargoExtraHabilitado();
	
?>
<form name='formSetear' id='formSetear' method='post' action="<?php print($_SERVER['PHP_SELF']); ?>">
	<div id="content">
		<fieldset>
			<legend>Mensaje</legend>
			<div>
				<div>
			  		<label for="d_nombre">Hora Inicio <em>*</em></label>
			  		<input id="d_hora_inicio" type="text" size="2" maxlength="2" name="d_hora_inicio" value=<?php print($hora_inicio);?> />
					<br></br>
			  		<label for="d_nombre">Hora Fin <em>*</em></label>
			  		<input id="d_hora_fin" type="text" size="2" maxlength="2" name="d_hora_fin" value=<?php print($hora_fin);?> />
					<br></br>
		  			<input type="submit" name="cambiarMensaje" value="Cambiar" >
				</div>
			</div>
		</fieldset>
		<br></br>			
		<fieldset>
			<legend>Configuracion Mail</legend>
			<div>
				<div>
			  		<label for="usuario_mail">Usuario Mail <em>*</em></label>
			  		<input id="usuario_mail" type="text" size="50" maxlength="50" name="usuario_mail" value=<?php print($usuario_mail);?> />
						<br></br>
			  		<label for="pass_mail">Pass Mail <em>*</em></label>
			  		<input id="pass_mail" type="text" size="50" maxlength="50" name="pass_mail" value="<?php print($pass_mail);?>"/>
			  		<br></br>
			  		<label for="host_mail">Host Mail <em>*</em></label>
			  		<input id="host_mail" type="text" size="50" maxlength="50" name="host_mail" value="<?php print($host_mail);?>"/>
			  		<br></br>
			  		<label for="port_mail">Port Mail <em>*</em></label>
			  		<input id="port_mail" type="text" size="50" maxlength="50" name="port_mail" value="<?php print($port_mail);?>"/>
			  		<br></br>
			  		<label for="from_mail">From Mail <em>*</em></label>
			  		<input id="from_mail" type="text" size="50" maxlength="50" name="from_mail" value="<?php print($from_mail);?>"/>
			  		<br></br>
			  		<label for="nombre_from">Nombre Mail <em>*</em></label>
			  		<input id="nombre_from" type="text" size="50" maxlength="50" name="nombre_from" value="<?php print($nombre_from);?>" />
			  		<br></br>		  			
		  			<input type="submit" name="cambiarMail" value="Cambiar" >
				</div>
			</div>
		</fieldset>
		<br></br>			
		<fieldset>
			<legend>CARGO EXTRA HABILITADO</legend>
			<div>
				<div>
			  		<label for="d_nombre">Cargo Extra Habilitado <em>*</em></label>
			  		<input id="d_cargo_e_habilitado" type="text" size="2" maxlength="2" name="d_cargo_e_habilitado" value=<?php print($cargoExtraHabilitado);?> />
		  			<input type="submit" name="cambiarCargo" value="Cambiar" >
				</div>
			</div>
		</fieldset>		
	</div>
</form>
</body>