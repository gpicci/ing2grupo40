function checkUsuario(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('nombre').value == '') ||
		(document.getElementById('apellido').value == '') ||
		(document.getElementById('fecha_nacimiento').value == '') ||
		(document.getElementById('correo_electronico').value == '') ||		
		(document.getElementById('clave').value == '')) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function validarEmail(email ) {
	if ((email != ' ')&&(email != '')&&(email != null)){
      expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if ( !expr.test(email) ) {
        alert('Verifique la direccion de correo');
        return false;
      }
	}

	return true;
}

function isValidKey(evt)
{
	tecla = (document.all) ? evt.keyCode : evt.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\w\r]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}

function performAltaVehiculo(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=vehiculoView&folder=views';
	document.getElementById(theForm).submit();
}

function performModVehiculo(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=vehiculoView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaVehiculo(theForm) {
	check = confirm('Confirme la eliminacion del vehiculo.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=vehiculoABM&folder=abm';
		document.getElementById(theForm).submit();
	}
}

function checkVehiculo(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('modelo_id').value == '') ||
		(document.getElementById('cantidad_asientos').value == '') ||	
		(document.getElementById('patente').value == '')) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function checkViaje(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('duracion').value == '') ||	
		(document.getElementById('costo').value == '')) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function apruebaPostulacion(theForm) {
	document.getElementById('op').value = 'v';
	document.getElementById(theForm).action = 'main.php?accion=viajeABM&folder=abm';
	document.getElementById(theForm).submit();
}

function desapruebaPostulacion(theForm) {
	document.getElementById('op').value = 'z';
	document.getElementById(theForm).action = 'main.php?accion=viajeABM&folder=abm';
	document.getElementById(theForm).submit();
}

function performAltaViaje(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=viajeView&folder=views';
	document.getElementById(theForm).submit();
}

function performModViaje(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=viajeView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaViaje(theForm) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=viajeView&folder=views';
		document.getElementById(theForm).submit();
}

function performPostulacion(theForm) {
	check = confirm('Confirme la postulacion al viaje seleccionado.');
	if (check) {
		document.getElementById('op').value = 'p';
		document.getElementById(theForm).action = 'main.php?accion=viajeABM&folder=abm';
		document.getElementById(theForm).submit();
	}
}
