function checkUsuario(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('nombre').value == '') ||
		(document.getElementById('apellido').value == '') ||
		(document.getElementById('fecha_nacimiento').value == '') ||
		(document.getElementById('correo_electronico').value == '') ||
		(document.getElementById('clave').value == '')) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		if (validarEmail(document.getElementById('correo_electronico').value)){
			if (esfechavalida(document.getElementById('fecha_nacimiento').value)) {
				document.getElementById(theForm).submit();
			}
		} else {
			alert('Verifique la direccion de correo.');
		}
	}



}

function esfechavalida(fecha) {

    // La longitud de la fecha debe tener exactamente 10 caracteres
    if ( fecha.length !== 10 )
       error = true;

    // Primero verifica el patron
    if ( !/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(fecha) )
       error = true;

    // Mediante el delimitador "-" separa dia, mes y año
    var fecha = fecha.split("-");
    var day = parseInt(fecha[0]);
    var month = parseInt(fecha[1]);
    var year = parseInt(fecha[2]);

    // Verifica que dia, mes, año, solo sean numeros
    error = ( isNaN(day) || isNaN(month) || isNaN(year) );

    // Lista de dias en los meses, por defecto no es año bisiesto
    var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
    if ( month === 1 || month > 2 )
       if ( day > ListofDays[month-1] || day < 0 || ListofDays[month-1] === undefined )
          error = true;

    // Detecta si es año bisiesto y asigna a febrero 29 dias
    if ( month === 2 ) {
       var lyear = ( (!(year % 4) && year % 100) || !(year % 400) );
       if ( lyear === false && day >= 29 )
          error = true;
       if ( lyear === true && day > 29 )
          error = true;
    }

    if ( error === true ) {
       alert("Fecha Inválida: * La Fecha debe tener el formato: dd-mm-aaaa.\n");
       return false;
    }
    else
    	return true;
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

function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

   return true;
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
	var actual = new Date();
	// Validacion de campos obligatorios
	if ((document.getElementById('duracion').value == '') ||
		(document.getElementById('vehiculo_id').value == '') ||
		(document.getElementById('tarjeta_id').value == -1) ||
		(document.getElementById('costo').value == '')) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		if (esfechavalida(document.getElementById('fecha_salida').value)) {
			document.getElementById(theForm).submit();
		}
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
		document.getElementById('op').value = 'p';
		document.getElementById(theForm).action = 'main.php?accion=postulacionView&folder=views';
		document.getElementById(theForm).submit();
}

function performVerViaje(theForm) {
	document.getElementById('op').value = 'd';
	document.getElementById(theForm).action = 'main.php?accion=viajeView&folder=views';
	document.getElementById(theForm).submit();
}

function performCerrarViaje(theForm) {
	check = confirm('Confirme el cierre del viaje (ya no se aceptaran postulaciones y se emitira el cobro)');
	if (check) {
		document.getElementById('op').value = 'c';
		document.getElementById(theForm).action = 'main.php?accion=cierreViajeView&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkPostulacion(theForm) {
	// Validacion de campos obligatorios
	if ( (document.getElementById('tarjeta_id').value == -1) ) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

 function preview_image(event) {//previsualizacion de la portada
    	    var reader = new FileReader();
    	    reader.onload = function(){
            var output = document.getElementById('img');
            output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

function reset_image(id){
	document.getElementById("img").src="./views/mostrarImagen.php?id=" + id;
	document.getElementById("foto").value ='mantener';
}

 function checkTarjeta(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('n_tarjeta').value == '') {
		alert('El numero de tarjeta es obligatorio, por favor verifique los datos ingresados');
	} else {
		if ((document.getElementById('n_mes_vence').value == '0') || (document.getElementById('n_anio_vence').value == '0')) {
			alert('La fecha de vencimiento es obligatoria, por favor verifique los datos ingresados');
		} else {
			if (document.getElementById('n_codigo_verificador').value == '') {
				alert('El digito verificador es obligatorio, por favor verifique los datos ingresados');
			} else {
				if (document.getElementById('d_nombre_titular').value == '') {
					alert('El nombre del titular es obligatorio, por favor verifique los datos ingresados');
				} else {
					if (document.getElementById('n_tarjeta').value.length < 16) {
						alert('Debe ingresar 16 digitos para el numero de tarjeta');
					} else {
						if (document.getElementById('n_codigo_verificador').value.length < 3) {
							alert('Debe ingresar 3 digitos para el codigo verificador de tarjeta');
						} else {
							document.getElementById(theForm).submit();
						}
					}
				}
			}
		}
	}
}

function performAltaTarjeta(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=tarjetaView&folder=views';
	document.getElementById(theForm).submit();
}

function performModTarjeta(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=tarjetaView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaTarjeta(theForm) {
	check = confirm('Confirme la eliminacion de la tarjeta.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=tarjetaABM&folder=abm';
		document.getElementById(theForm).submit();
	}
}

function performCerrarSesion() {
	check = confirm('Confirme cerrar sesion');
	if (check) {
		 window.location.href = "logout.php";
	}
}

function performBajaPostulacion(theForm) {
	check = confirm('Confirme la baja de la postulacion. En caso de que ya haya sido aprobada bajara su calificacion');
	if (check) {
		document.getElementById('op').value = 'bp';
		document.getElementById(theForm).action = 'main.php?accion=viajeABM&folder=abm';
		document.getElementById(theForm).submit();
	}
}

function performTerminarViaje(theForm) {
	check = confirm('Al marcar un viaje como terminado dejara de estar activo y las calificaciones estaran pendientes de cargar');
	if (check) {
		document.getElementById('op').value = 't';
		document.getElementById(theForm).action = 'main.php?accion=viajeABM&folder=abm';
		document.getElementById(theForm).submit();
	}
}

function performFiltrosViajes(theForm) {

	document.getElementById(theForm).submit();
}
