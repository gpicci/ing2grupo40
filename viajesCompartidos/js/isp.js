function clearFilter(theForm, sort, pagTotal, pagActual, filterId, clearValue) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	document.getElementById(filterId).value = clearValue;
	document.getElementById(theForm).submit();
}

function submitForm(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	//document.getElementById('filtro').value = filtro;
	document.getElementById(theForm).submit();
}

function changePageUsuario(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idUsuario.length == undefined) {
		document.getElementById(theForm).idUsuario.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idUsuario.length;i++){
			document.getElementById(theForm).idUsuario[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function changePageCliente(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	document.getElementById('order').value = order;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idCliente.length == undefined) {
		document.getElementById(theForm).idCliente.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idCliente.length;i++){
			document.getElementById(theForm).idCliente[i].value = -1;
		}
	}

	document.getElementById(theForm).submit();
}

function changePageClienteSeleccion(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idCliente.length == undefined) {
		document.getElementById(theForm).idCliente.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idCliente.length;i++){
			document.getElementById(theForm).idCliente[i].value = -1;
		}
	}

	document.getElementById(theForm).submit();
}

function changePageLocalidad(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idLocalidad.length == undefined) {
		document.getElementById(theForm).idLocalidad.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idLocalidad.length;i++){
			document.getElementById(theForm).idLocalidad[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function changePageDispositivo(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById('idDispositivo') != null) {
		if (document.getElementById(theForm).idDispositivo.length == undefined) {
			document.getElementById(theForm).idDispositivo.value = -1;
		} else {
			for (i=0;i<document.getElementById(theForm).idDispositivo.length;i++){
				document.getElementById(theForm).idDispositivo[i].value = -1;
			}
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaUsuario(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=usuarioView&folder=views';
	document.getElementById(theForm).submit();
}

function performModUsuario(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=usuarioView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaUsuario(theForm) {
	check = confirm('Confirme la eliminacion del usuario.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=usuarioABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkUsuario(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('nombre').value == '') ||
		(document.getElementById('nombreUsuario').value == '') ||
		(document.getElementById('password').value == '') ||
		(document.getElementById('direccion').value == '')) {
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

function checkCliente(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('d_nombre').value == '') ||
		(document.getElementById('d_direccion_instalacion').value == '') ||
		(document.getElementById('d_numero').value == '') ||
		(document.getElementById('c_id_calle').value == -1)
		) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		if ((document.getElementById('d_email').value != ' ')&&(document.getElementById('d_email').value != '')&&(document.getElementById('d_email') != null)){
		  if (validarEmail(document.getElementById('d_email').value)) {
		    document.getElementById(theForm).submit();
		  }
		} else {
			document.getElementById(theForm).submit();
		}
	}
}

function calculaEdad() {
	var dia = document.getElementById('diaNac').value;
	var mes = document.getElementById('mesNac').value;
	var ano = document.getElementById('anoNac').value;
	d = new Date();
	var diaActual = d.getDate();
	var mesActual = d.getMonth();
	var anoActual = d.getFullYear();

	//si el mes es el mismo pero el dia inferior aun no ha cumplido anios,
	//le quitaremos un anio al actual
	// O
	//si el mes es superior al actual tampoco habra cumplido anios,
	//por eso le quitamos un anio al actual
	if (((mes == mesActual) && (dia > diaActual)) ||
		(mes > mesActual)) {
		anoActual = anoActual - 1;
	}

	document.getElementById('edad').value = anoActual - ano;
}

function changeConsultasPage(theForm, pagTotal, pagActual, idPaciente, idFicha) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('idPaciente').value = idPaciente;
	document.getElementById('idFicha').value = idFicha;
	if (document.getElementById(theForm).idDet.length == undefined) {
		document.getElementById(theForm).idDet.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idDet.length;i++){
			document.getElementById(theForm).idDet[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaConsulta(theForm, idPaciente, idFicha) {
	document.getElementById('op').value = 'a';
	document.getElementById('idPaciente').value = idPaciente;
	document.getElementById('idFicha').value = idFicha;
	document.getElementById(theForm).action = 'main.php?accion=fichaDet';
	document.getElementById(theForm).submit();
}

function performModConsulta(theForm, idPaciente, idFicha, idDet) {
	document.getElementById('op').value = 'm';
	document.getElementById('idPaciente').value = idPaciente;
	document.getElementById('idFicha').value = idFicha;
	document.getElementById('idDet').value = idDet;
	document.getElementById(theForm).action = 'main.php?accion=fichaDet';
	document.getElementById(theForm).submit();
}

function performBajaConsulta(theForm) {
	check = confirm('Confirme la eliminacion de la consulta.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'fichaDetABM.php';
		document.getElementById(theForm).submit();
	}
}

function performAltaCliente(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=clienteView';
	document.getElementById(theForm).submit();
}

function performModCliente(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=clienteView';
	document.getElementById(theForm).submit();
}

function performViewServicios(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=servicios';
	document.getElementById(theForm).submit();
}

function performOpenServicios(theForm) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(800/2);
	posicion_y=(screen.height/2)-(500/2);

	window.open('servicioView.php?id='+document.getElementById('idCliente').value,'servicioView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=500, left='+posicion_x+', top='+posicion_y+'');
}

function performBajaServicio(theForm, idUser) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(300/2);
	posicion_y=(screen.height/2)-(300/2);

	if (document.getElementById(theForm).idServicio.length == undefined) {
        if(document.getElementById(theForm).idServicio.checked) var idServicio = document.getElementById(theForm).idServicio.value;
	} else {
		for(i=0; i<document.getElementById(theForm).idServicio.length; i++)
			if(document.getElementById(theForm).idServicio[i].checked) var idServicio = document.getElementById(theForm).idServicio[i].value;
	}

	check = confirm('Confirme la eliminacion del servicio.');
	if (check) {
		window.open('servicioFechaBaja.php?ids='+idServicio+'&idu='+idUser,'bajaServicio','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=300,height=300, left='+posicion_x+', top='+posicion_y+'');
	}
}

function performBajaServicioFecha(theForm) {
	document.getElementById('op').value = 'b';
	document.getElementById(theForm).action = 'servicioABM.php';
	document.getElementById(theForm).submit();
}

function performCloseFechaBajaServicioView(theForm) {
	window.opener.location = 'main.php?accion=servicios';
	window.close();
}

function performAltaServicio(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'servicioABM.php';
	document.getElementById(theForm).submit();

}

function performCloseServicioView(theForm) {
	window.opener.location = 'main.php?accion=servicios';
	window.close();
}

function performAltaDispositivo(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=dispositivoView';
	document.getElementById(theForm).submit();
}

function performModDispositivo(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=dispositivoView';
	document.getElementById(theForm).submit();
}

function performBajaDispositivo(theForm,idDisp) {
	var dispSeleccionado = false;

	if (document.getElementById(theForm).idDispositivo.length == undefined) {
        if(document.getElementById(theForm).idDispositivo.checked) dispSeleccionado = true;
	} else {
		for(i=0; i<document.getElementById(theForm).idDispositivo.length; i++)
			if(document.getElementById(theForm).idDispositivo[i].checked) dispSeleccionado = true;
	}

	if (dispSeleccionado) {
		var res = document.getElementById(theForm).idDispositivo.value.split("-");

		if (res[1]!= 0){
			alert("El dispisitivo tiene clientes asociados, verifique.");
		} else {

			check = confirm('Confirme la eliminacion del dispositivo');
			if (check) {
				document.getElementById('op').value = 'b';
				document.getElementById(theForm).action = 'dispositivoABM.php';
				document.getElementById(theForm).submit();
			}
		}
	}
}

function performAltaLocalidad(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=localidadView&folder=views';
	document.getElementById(theForm).submit();
}

function performModLocalidad(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=localidadView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaLocalidad(theForm) {
	check = confirm('Confirme la eliminacion de la localidad.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=localidadABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkLocalidad(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('nombre').value == '') {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageCalle(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idCalle.length == undefined) {
		document.getElementById(theForm).idCalle.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idCalle.length;i++){
			document.getElementById(theForm).idCalle[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaCalle(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=calleView&folder=views';
	document.getElementById(theForm).submit();
}

function performModCalle(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=calleView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaCalle(theForm) {
	check = confirm('Confirme la eliminacion de la localidad.');
	if (check) {
		document.getElementById('op').value = 'b';
		//document.getElementById(theForm).action = 'views/calleABM.php';
		document.getElementById(theForm).action = 'main.php?accion=calleABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkCalle(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('nombre').value == '') {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageTipoDisp(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idTipoDispositivo.length == undefined) {
		document.getElementById(theForm).idTipoDispositivo.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idTipoDispositivo.length;i++){
			document.getElementById(theForm).idTipoDispositivo[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaTipoDispositivo(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=tipoDispositivoView';
	document.getElementById(theForm).submit();
}

function performModTipoDispositivo(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=tipoDispositivoView';
	document.getElementById(theForm).submit();
}

function checkTipoDispositivo(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('d_descripcion').value == '') {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageArticulo(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idArticulo.length == undefined) {
		document.getElementById(theForm).idArticulo.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idArticulo.length;i++){
			document.getElementById(theForm).idArticulo[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaArticulo(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=articuloView';
	document.getElementById(theForm).submit();
}

function performModArticulo(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=articuloView';
	document.getElementById(theForm).submit();
}

function performBajaArticulo(theForm) {
	check = confirm('Confirme la eliminacion del articulo.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'articuloABM.php';
		document.getElementById(theForm).submit();
	}
}

function checkArticulo(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('d_descripcion').value == '') {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageProveedor(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idProveedor.length == undefined) {
		document.getElementById(theForm).idProveedor.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idProveedor.length;i++){
			document.getElementById(theForm).idProveedor[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaProveedor(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=proveedorView';
	document.getElementById(theForm).submit();
}

function performModProveedor(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=proveedorView';
	document.getElementById(theForm).submit();
}

function checkProveedor(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('d_nombre').value == '')) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageMotivoCorte(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idMotivoCorte.length == undefined) {
		document.getElementById(theForm).idMotivoCorte.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idMotivoCorte.length;i++){
			document.getElementById(theForm).idMotivoCorte[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaMotivoCorte(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=motivoCorteView';
	document.getElementById(theForm).submit();
}

function performModMotivoCorte(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=motivoCorteView';
	document.getElementById(theForm).submit();
}

function checkMotivoCorte(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('d_descripcion').value == '')) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function performAsignarLocalidades(theForm) {
	window.open('localidadesCalles.php?id='+document.getElementById('idCalle').value,'localidadesCalles','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=400');
}

function performAsignarLocalidadCalle(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'localidadesCallesABM.php';
	document.getElementById(theForm).submit();

}

function performDesasignarLocalidadCalle(theForm) {
	document.getElementById('op').value = 'b';
	document.getElementById(theForm).action = 'localidadesCallesABM.php';
	document.getElementById(theForm).submit();

}

function performCloseLocalidadesCallesView(theForm) {
	 window.opener.location = 'main.php?accion=calles&folder=browse';
	 window.close();
}

function performAsignarCalles(theForm) {
	var idLoc = 0;
	if (document.getElementById(theForm).idLocalidad.length == undefined) {
		idLoc = document.getElementById(theForm).idLocalidad.value;
	} else {
		for (i=0;i<document.getElementById(theForm).idLocalidad.length;i++){
			if (document.getElementById(theForm).idLocalidad[i].checked) {
				idLoc = document.getElementById(theForm).idLocalidad[i].value;
			}
		}
	}

	window.open('callesLocalidades.php?id='+idLoc,'callesLocalidades','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=400');
}

function performAsignarCalleLocalidad(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'callesLocalidadesABM.php';
	document.getElementById(theForm).submit();

}

function performDesasignarCalleLocalidad(theForm) {
	document.getElementById('op').value = 'b';
	document.getElementById(theForm).action = 'callesLocalidadesABM.php';
	document.getElementById(theForm).submit();

}

function performCloseCallesLocalidadesView(theForm) {
	 window.opener.location = 'main.php?accion=localidad&folder=browse';
	 window.close();
}

function performAltaPosibleCliente(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=posibleClienteView';
	document.getElementById(theForm).submit();
}

function performModPosibleCliente(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=posibleClienteView';
	document.getElementById(theForm).submit();
}

function performBajaPosibleCliente(theForm) {
	check = confirm('Confirme la eliminacion del posible cliente.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'posibleClienteABM.php';
		document.getElementById(theForm).submit();
	}
}

function performViewClienteRegular(theForm) {
	document.getElementById('op').value = 'cr';
	document.getElementById(theForm).action = 'main.php?accion=clienteView';
	document.getElementById(theForm).submit();
}

function checkPosibleCliente(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('d_nombre').value == '') ||
		(document.getElementById('d_numero').value == '') ||
		(document.getElementById('c_id_calle').value == -1)
		) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePagePosibleCliente(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idPosibleCliente.length == undefined) {
		document.getElementById(theForm).idPosibleCliente.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idPosibleCliente.length;i++){
			document.getElementById(theForm).idPosibleCliente[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performBajaCliente(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=clienteBaja';
	document.getElementById(theForm).submit();
}

function performCloseBajaAdministrativa(theForm) {
	 window.opener.location = 'main.php?accion=clientes';
	 window.close();
}

function caps(element){
		element.value = element.value.toUpperCase();
}

function low(element){
	element.value = element.value.toLowerCase();
}

function performAltaAccesorioChequeo(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=accesorioChequeoView';
	document.getElementById(theForm).submit();
}

function performModAccesorioChequeo(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=accesorioChequeoView';
	document.getElementById(theForm).submit();
}

function performBajaAccesorioChequeo(theForm) {
	check = confirm('Confirme la eliminacion del accesorio');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'accesorioChequeoABM.php';
		document.getElementById(theForm).submit();
	}
}

function checkAccesorioChequeo(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('descripcion').value == '') ) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageAccesorioChequeo(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idAccesorio.length == undefined) {
		document.getElementById(theForm).idAccesorio.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idAccesorio.length;i++){
			document.getElementById(theForm).idAccesorio[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performViewChequeoVisual(theForm) {

	if (document.getElementById(theForm).idPosibleCliente.length == undefined) {
        if(document.getElementById(theForm).idPosibleCliente.checked) var idPosibleCliente = document.getElementById(theForm).idPosibleCliente.value;
	} else {
		for(i=0; i<document.getElementById(theForm).idPosibleCliente.length; i++)
			if(document.getElementById(theForm).idPosibleCliente[i].checked) var idPosibleCliente = document.getElementById(theForm).idPosibleCliente[i].value;
	}

	window.open('chequeoVisualView.php?id='+idPosibleCliente,'chequeoVisualView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500');
}

function performAltaChequeoVisual(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'chequeoVisualABM.php';
	document.getElementById(theForm).submit();

}

function performModChequeoVisual(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'chequeoVisualABM.php';
	document.getElementById(theForm).submit();

}

function performCloseChequeoVisualView(theForm) {
	window.opener.location = 'main.php?accion=posiblesClientes';
	window.close();
}

function performPrintPosiblesClientes(nombre, localidad, estado, sort) {
	window.open('posiblesClientesRPT.php?nom='+nombre+'&loc='+localidad+'&st='+estado+"&s="+sort,'PosiblesClientesRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500');
}

function changePageNodo(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idNodo.length == undefined) {
		document.getElementById(theForm).idNodo.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idNodo.length;i++){
			document.getElementById(theForm).idNodo[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function changePageNodoPopup(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idNodoNuevo.length == undefined) {
		document.getElementById(theForm).idNodoNuevo.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idNodoNuevo.length;i++){
			document.getElementById(theForm).idNodoNuevo[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaNodo(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=nodoView';
	document.getElementById(theForm).submit();
}

function performModNodo(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=nodoView';
	document.getElementById(theForm).submit();
}

function performBajaNodo(theForm) {
	check = confirm('Confirme la eliminacion del nodo.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'nodoABM.php';
		document.getElementById(theForm).submit();
	}
}

function checkNodo(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('d_nombre').value == '') ) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageAP(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idAP.length == undefined) {
		document.getElementById(theForm).idAP.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idAP.length;i++){
			document.getElementById(theForm).idAP[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaAP(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=apView';
	document.getElementById(theForm).submit();
}

function performModAP(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=apView';
	document.getElementById(theForm).submit();
}

function performBajaAP(theForm) {
	check = confirm('Confirme la eliminacion del nodo.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'APABM.php';
		document.getElementById(theForm).submit();
	}
}

function checkAP(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('c_id_tipo_ap').value == '') ) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageTipoAP(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idTipoAP.length == undefined) {
		document.getElementById(theForm).idTipoAP.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idTipoAP.length;i++){
			document.getElementById(theForm).idTipoAP[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performAltaTipoAP(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=tipoAPView';
	document.getElementById(theForm).submit();
}

function performModTipoAP(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=tipoAPView';
	document.getElementById(theForm).submit();
}

function checkTipoAP(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('d_descripcion').value == '') {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}


function performAltaTemaInc(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=tema_incView&folder=views';
	document.getElementById(theForm).submit();
}

function performModTemaInc(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=tema_incView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaTemaInc(theForm) {
	check = confirm('Confirme la eliminacion del tema de incidencia.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=tema_incABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkTemaInc(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('descripcion').value == '') {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageTemaInc(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idTemaInc.length == undefined) {
		document.getElementById(theForm).idTemaInc.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idTemaInc.length;i++){
			document.getElementById(theForm).idTemaInc[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}


function performAltaIncidencia(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=incidenciaView&folder=views';
	document.getElementById(theForm).submit();
}

function performModIncidencia(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=incidenciaView&folder=views';
	document.getElementById(theForm).submit();
}

function performVerSinActividad(theForm) {
	document.getElementById('filtroActividad').value = '1';
	document.getElementById(theForm).submit();
}

function performVerTodas(theForm) {
	document.getElementById('filtroActividad').value = '-1';
	document.getElementById(theForm).submit();
}

function performBajaIncidencia(theForm) {

	check = confirm('Confirme la eliminacion de la incidencia.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=incidenciaABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function performPasajesIncidencia(theForm) {
	//limpio el campo de sort antes de pasar al abm de pasajes
	document.getElementById(theForm).action = 'main.php?accion=pasajesInc&folder=browse';
	document.getElementById(theForm).submit();
}

function performPasajesIncidenciaCerrada(theForm) {
	//limpio el campo de sort antes de pasar al abm de pasajes
	document.getElementById('sort').value = '';
	document.getElementById(theForm).action = 'main.php?accion=pasajesInc&folder=browse';
	document.getElementById(theForm).submit();
}

function changePageIncidencias(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById('idIncidencia') != null) {
		if (document.getElementById(theForm).idIncidencia.length == undefined) {
			document.getElementById(theForm).idIncidencia.value = -1;
		} else {
			for (i=0;i<document.getElementById(theForm).idIncidencia.length;i++){
				document.getElementById(theForm).idIncidencia[i].value = -1;
			}
		}
	}
	document.getElementById(theForm).submit();
}

function performViewIncidencias(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=incidenciasCliente&folder=browse';
	document.getElementById(theForm).submit();
}

function performViewIncidenciasCliente(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=incidenciasCliente&folder=browse';
	document.getElementById(theForm).submit();
}

function performAltaPasajeInc(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=pasajeIncView&folder=views';
	document.getElementById(theForm).submit();
}

function performModPasajeInc(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=pasajeIncView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaPasajeInc(theForm) {
	check = confirm('Confirme la eliminacion del pasaje de incidencia.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=pasajeIncABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkPasajeInc(theForm) {
	/*
	if (document.getElementById('id_usuario_recibe').value = document.getElementById('id_usuario_envia').value)) {
		alert('El usuario que envia y el que recibe no pueden ser el mismo.');
	} else {
		document.getElementById(theForm).submit();
	}
	*/
	//por defecto hago el submit
	document.getElementById(theForm).submit();

}

function performViewCotizaciones(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=cotizaciones';
	document.getElementById(theForm).submit();
}

function performOpenCotizaciones(theForm) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(800/2);
	posicion_y=(screen.height/2)-(300/2);

	window.open('cotizacionView.php?id='+document.getElementById('idArticulo').value,'cotizacionView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=300, left='+posicion_x+', top='+posicion_y+'');
}

function performBajaCotizaciones(theForm) {
	check = confirm('Confirme la eliminacion de la cotizacion.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'cotizacionABM.php';
		document.getElementById(theForm).submit();
	}
}

function performAltaCotizacion(theForm) {
	check = confirm('Confirme alta de Cotizacion: Importe = $'+document.getElementById('i_servicio').value+' // Importe Liquidacion = $'+document.getElementById('i_liquidacion').value);
	if (check) {
		document.getElementById('op').value = 'a';
		document.getElementById(theForm).action = 'cotizacionABM.php';
		document.getElementById(theForm).submit();
	}

}

function performCloseCotizacionView(theForm) {
	 window.opener.location = 'main.php?accion=cotizaciones';
	 window.close();
}

function performAnotacionesIncidencia(theForm) {
	//limpio el campo de sort antes de pasar al abm de pasajes
	document.getElementById(theForm).action = 'main.php?accion=anotacionesInc&folder=browse';
	document.getElementById(theForm).submit();
}

function performAnotacionesIncidenciaCerrada(theForm) {
	//limpio el campo de sort antes de pasar al abm de pasajes
	document.getElementById('sort').value = '';
	document.getElementById(theForm).action = 'main.php?accion=anotacionesInc&folder=browse';
	document.getElementById(theForm).submit();
}


function performAltaAnotacionInc(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=anotacionIncView&folder=views';
	document.getElementById(theForm).submit();
}

function performModAnotacionInc(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=anotacionIncView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaAnotacionInc(theForm) {
	check = confirm('Confirme la eliminacion de la Anotacion de incidencia.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=anotacionIncABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkAnotacionInc(theForm) {
	if ((document.getElementById('d_texto').value == '') ) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}


}

function performViewBonificaciones(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=bonificaciones';
	document.getElementById(theForm).submit();
}

function performOpenBonificaciones(theForm) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(900/2);
	posicion_y=(screen.height/2)-(400/2);

	window.open('bonificacionView.php?id='+document.getElementById('idServicio').value,'bonificacionView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=400, left='+posicion_x+', top='+posicion_y+'');
}

function performBajaBonificacion(theForm) {
	check = confirm('Confirme la eliminacion de la bonificacion.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'bonificacionABM.php';
		document.getElementById(theForm).submit();
	}
}

function performAltaBonificacion(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'bonificacionABM.php';
	document.getElementById(theForm).submit();

}

function performCloseBonificacionView(theForm) {
	 window.opener.location = 'main.php?accion=bonificaciones';
	 window.close();
}

function performViewPagos(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=pagos&origen='+document.getElementById('origen').value;
	document.getElementById(theForm).submit();
}

var clickPago = false;
function performAltaPago(theForm) {
	if (! clickPago) {
		clickPago = true;
		var pagoSeleccionado = false;

		if (document.getElementById(theForm).idPago.length == undefined) {
	        if(document.getElementById(theForm).idPago.checked) pagoSeleccionado = true;
		} else {
			for(i=0; i<document.getElementById(theForm).idPago.length; i++)
				if(document.getElementById(theForm).idPago[i].checked) pagoSeleccionado = true;
		}

		if (pagoSeleccionado) {
			if ((document.getElementById('d_letra_comprobante').value!='N')&&(document.getElementById('n_comprobante_1').value == ''||document.getElementById('n_comprobante_2').value == '')) {
				alert('Ingrese un valor para el numero de comprobante.');
				clickPago = false;
			} else {
				document.getElementById('op').value = 'a';
				document.getElementById(theForm).action = 'pagoConDetalleABM.php';
				document.getElementById(theForm).submit();
			}
		} else {
			alert('Seleccione al menos un pago.');
			clickPago = false;
		}
	}
}

function performBajaPago(theForm) {
	var pagoSeleccionado = false;

	for(sel=0; sel<document.getElementById(theForm).idPago.length; sel++) {
		if(document.getElementById(theForm).idPago[sel].checked) pagoSeleccionado = true;
	}

	if (pagoSeleccionado) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'pagoConDetalleABM.php';
		document.getElementById(theForm).submit();
	} else {
		alert('Seleccione al menos un pago.');
	}
}

function performImprimirPago(theForm, idCliente) {
	var pagoSeleccionado = false;

	for(sel=0; sel<document.getElementById(theForm).idPago.length; sel++) {
		if(document.getElementById(theForm).idPago[sel].checked) {
			if (document.getElementById(theForm).idPago[sel].value.substring(document.getElementById(theForm).idPago[sel].value.indexOf('-')+1, document.getElementById(theForm).idPago[sel].value.length) != 0) {
				var res = document.getElementById(theForm).idPago[sel].value.split("-");

				if (res[1] ==0) {
					alert("Debe seleccionar un periodo PAGADO para poder imprimir");
				} else {
					window.open('reciboConDetalleRPT.php?id='+idCliente+'&idp='+document.getElementById(theForm).idPago[sel].value,'ReciboRPT'+sel,'status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500');
				}
			}
		}
	}
}

function performAnularPago(theForm) {
	var pagoSeleccionado = false;
	
	if (document.getElementById(theForm).idPago.length == undefined) {
        if(document.getElementById(theForm).idPago.checked) pagoSeleccionado = true;
	} else {
		for(i=0; i<document.getElementById(theForm).idPago.length; i++)
			if(document.getElementById(theForm).idPago[i].checked) pagoSeleccionado = true;
	}

	if (pagoSeleccionado) {
		document.getElementById('op').value = 'an';
		document.getElementById(theForm).action = 'pagoConDetalleABM.php';
		document.getElementById(theForm).submit();
	} else {
		alert('Seleccione al menos un pago.');
	}
}

function performGenerarOrden(theForm) {

		document.getElementById('op').value = 'a';
		document.getElementById(theForm).action = 'main.php?accion=dispositivosOrdenTecnica';
		document.getElementById(theForm).submit();
}

function performSelDispCableado(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=nodosOrdenTecnica';
	document.getElementById(theForm).submit();
}


function performSelDispOrden(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=ordenTecnicaView&idCliente='+document.getElementById('idCliente').value+'&idDispositivo='+document.getElementById('idDispositivo').value+'&idTipoOrden=d';
	document.getElementById(theForm).submit();
}

function performSelNodoOrden(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'main.php?accion=ordenTecnicaView&idCliente='+document.getElementById('idCliente').value+'&idNodo='+document.getElementById('idNodo').value+'&idTipoOrden=c';
	document.getElementById(theForm).submit();
}


function checkOrdenTecnica(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('c_id_dispositivo').value == 0) {
		alert('Seleccione un dipositivo');
	} else {
		document.getElementById(theForm).submit();
	}
}

function performViewIncidenciasNodo(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=incidenciasNodo&folder=browse';
	document.getElementById(theForm).submit();
}

function performModificarOrden(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=ordenTecnicaView';
	document.getElementById(theForm).submit();
}

function performGrabarCerrarOrden(theForm) {
	if (document.getElementById('d_password').value == '') {
		alert('Ingrese Password');
	} else if (document.getElementById('d_usuario').value == '') {
		alert('Ingrese Nombre de Usuario');
	} else {
		check = confirm('Confirme el CIERRE de la Orden Tecnica');
		if (check) {
			document.getElementById('op').value = 'c';
			document.getElementById(theForm).action = 'ordenTecnicaABM.php';
			document.getElementById(theForm).submit();
		}
	}

}

function performConfirmarOrden(theForm) {
	check = confirm('Desea CONFIRMAR de la Orden Tecnica');
	if (check) {
		document.getElementById('op').value = 'x';
		document.getElementById(theForm).action = 'ordenTecnicaABM.php';
		document.getElementById(theForm).submit();
	}
}

function performCerrarOrden(theForm) {
	var posicion_x;
	var posicion_y;
	var v_width=800;
	var	v_height=400;
	posicion_x=(screen.width/2)-(v_width/2);
	posicion_y=(screen.height/2)-(v_height/2);

	if (document.getElementById(theForm).idOrdenTecnica.length == undefined) {
        if(document.getElementById(theForm).idOrdenTecnica.checked) var idOrdenTecnica = document.getElementById(theForm).idOrdenTecnica.value;
	} else {
		for(i=0; i<document.getElementById(theForm).idOrdenTecnica.length; i++)
			if(document.getElementById(theForm).idOrdenTecnica[i].checked) var idOrdenTecnica = document.getElementById(theForm).idOrdenTecnica[i].value;
	}

	window.open('cerrarOrdenTecnica.php?idOrdenTecnica='+idOrdenTecnica,'cerrar','status=0,scrollbars=1,location=no,directories=0,resizable=0,menu=no,width='+v_width+',height='+v_height+', left='+posicion_x+', top='+posicion_y+'');
}

function performCloseCerrarOrden(theForm) {
	 window.opener.location = 'main.php?accion=ordenTecnicaCerrar';
	 window.close();
}

function changePageDispOrden(theForm, sort, pagTotal, pagActual,cliente) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;

	document.getElementById('idCliente').value = cliente;
	document.getElementById(theForm).submit();
}

function changePageDispCambia(theForm, sort, pagTotal, pagActual,cliente) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;

	document.getElementById('idClienteActivo').value = cliente;
	document.getElementById(theForm).submit();
}

function changePageIncidencia(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idIncidencia.length == undefined) {
		document.getElementById(theForm).idIncidencia.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idIncidencia.length;i++){
			document.getElementById(theForm).idIncidencia[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performCambiarConexion (theForm){
	document.getElementById(theForm).action = 'main.php?accion=cambiarDispView&c_id_cliente='+document.getElementById('idClienteActivo').value+"&origen=CAMBIO";
	document.getElementById(theForm).submit();
}



function performAltaUbicacion(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=ubicacionView&folder=views';
	document.getElementById(theForm).submit();
}

function performModUbicacion(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=ubicacionView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaUbicacion(theForm) {
	check = confirm('Confirme la eliminacion la ubicacion.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=ubicacionABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkUbicacion(theForm) {
	// Validacion de campos obligatorios
	if (document.getElementById('descripcion').value == '') {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

function changePageUbicacion(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idUbicacion.length == undefined) {
		document.getElementById(theForm).idUbicacion.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idUbicacion.length;i++){
			document.getElementById(theForm).idUbicacion[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function performOpenCambioDisp(theForm,origen) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(1300/2);
	posicion_y=(screen.height/2)-(450/2);

	if (document.getElementById('idDispositivo') != null) {
		window.open('dispositivosCambioPopup.php?idClienteActivo='+document.getElementById('idClienteActivo').value+"&idDispositivo="+document.getElementById('idDispositivo').value+"&origen="+origen+"&liberaIP=0",'cambioDisp','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=1300,height=450, left='+posicion_x+', top='+posicion_y+'');
	} else {
		window.open('dispositivosCambioPopup.php?idClienteActivo='+document.getElementById('idClienteActivo').value+"&idDispositivo=0&origen="+origen+"&liberaIP=0",'cambioDisp','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=1200,height=450, left='+posicion_x+', top='+posicion_y+'');
	}
}

function performOpenCambioDispLiberaIP(theForm,origen) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(1200/2);
	posicion_y=(screen.height/2)-(450/2);

	if (document.getElementById('idDispositivo') != null) {
		window.open('dispositivosCambioPopup.php?idClienteActivo='+document.getElementById('idClienteActivo').value+"&idDispositivo="+document.getElementById('idDispositivo').value+"&origen="+origen+"&liberaIP=1",'cambioDisp','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=1200,height=450, left='+posicion_x+', top='+posicion_y+'');
	} else {
		window.open('dispositivosCambioPopup.php?idClienteActivo='+document.getElementById('idClienteActivo').value+"&idDispositivo=0&origen="+origen+"&liberaIP=1",'cambioDisp','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=1200,height=450, left='+posicion_x+', top='+posicion_y+'');
	}
}

function performOpenCambioNodo(theForm,origen) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(1200/2);
	posicion_y=(screen.height/2)-(450/2);

	if (document.getElementById('idNodo') != null) {
		window.open('nodosCambiaPopup.php?idClienteActivo='+document.getElementById('idClienteActivo').value+"&idNodo="+document.getElementById('idNodo').value+"&origen="+origen,'cambioNodo','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=1200,height=450, left='+posicion_x+', top='+posicion_y+'');
	} else {
		window.open('nodosCambiaPopup.php?idClienteActivo='+document.getElementById('idClienteActivo').value+"&idNodo=0"+"&origen="+origen,'cambioNodo','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=1200,height=450, left='+posicion_x+', top='+posicion_y+'');
	}
}

function performSelNodoCambia(theForm,origen){
	check = confirm('Confirme el CAMBIO DE NODO');
	if (check) {
		document.getElementById(theForm).action = 'cambiaConexionABM.php?idClienteActivo='+document.getElementById('idClienteActivo').value+'&idNodoNuevo='+document.getElementById('idNodoNuevo').value+"&origen="+origen;
		document.getElementById(theForm).submit();

	}
}

var clickCambio = false;
function performSelDispCambia(theForm,origen,liberaIP){
	if (! clickCambio) {
		clickCambio = true;
		var dispSeleccionado = false;

		if (document.getElementById(theForm).idDispositivoNuevo.length == undefined) {
	        if(document.getElementById(theForm).idDispositivoNuevo.checked) dispSeleccionado = true;
		} else {
			for(i=0; i<document.getElementById(theForm).idDispositivoNuevo.length; i++)
				if(document.getElementById(theForm).idDispositivoNuevo[i].checked) dispSeleccionado = true;
		}

		if (dispSeleccionado) {
		  check = confirm('Confirme el CAMBIO DE DISPOSITIVO');
		  if (check) {
			document.getElementById(theForm).action = 'cambiaConexionABM.php?idClienteActivo='+document.getElementById('idClienteActivo').value+'&idDispositivoNuevo='+document.getElementById('idDispositivoNuevo').value+"&origen="+origen+"&liberaIP="+liberaIP;
			document.getElementById(theForm).submit();
		  }
		} else {
			alert('Seleccione al menos un dispositivo.');
			clickCambio = false;
		}
	}
}

function performUbicacionesDisp(theForm) {
	//limpio el campo de sort antes de pasar al abm de ubicaciones
	document.getElementById('sort').value = '';
	document.getElementById('pagsTotal').value = -1;
	document.getElementById('pagActual').value = -1;

	document.getElementById(theForm).action = 'main.php?accion=ubicacionesDisp&folder=browse';
	document.getElementById(theForm).submit();
}

function performAltaUbicacionDisp(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=ubicacionDispView&folder=views';
	document.getElementById(theForm).submit();
}

function checkUbicacionDisp(theForm) {
	//por defecto hago el submit
	document.getElementById(theForm).submit();
}

function performCloseCerrarCambioNodo(theForm,origen) {
	 window.opener.location = 'main.php?accion=cambiarDispView&idClienteActivo='+document.getElementById('idClienteActivo').value+"&origen="+origen;
	 window.close();
}

function performCloseCerrarCambioDisp(theForm,origen) {
	 window.opener.location = 'main.php?accion=cambiarDispView&idClienteActivo='+document.getElementById('idClienteActivo').value+"&origen="+origen;
	 window.close();
}

function performImprimirOrdenTecnica(theForm){
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(900/2);
	posicion_y=(screen.height/2)-(500/2);

	if (document.getElementById(theForm).idOrdenTecnica.length == undefined) {
        if(document.getElementById(theForm).idOrdenTecnica.checked) var idOrdenTecnica = document.getElementById(theForm).idOrdenTecnica.value;
	} else {
		for(i=0; i<document.getElementById(theForm).idOrdenTecnica.length; i++)
			if(document.getElementById(theForm).idOrdenTecnica[i].checked) var idOrdenTecnica = document.getElementById(theForm).idOrdenTecnica[i].value;
	}

	window.open('ordenTecnicaRPT.php?idOrdenTecnica='+idOrdenTecnica,'OrdenTecnicaRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500, left='+posicion_x+', top='+posicion_y+'');
}

function performImprimirInformeTecnico(theForm){
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(900/2);
	posicion_y=(screen.height/2)-(500/2);

	if (document.getElementById(theForm).idOrdenTecnica.length == undefined) {
        if(document.getElementById(theForm).idOrdenTecnica.checked) var idOrdenTecnica = document.getElementById(theForm).idOrdenTecnica.value;
	} else {
		for(i=0; i<document.getElementById(theForm).idOrdenTecnica.length; i++)
			if(document.getElementById(theForm).idOrdenTecnica[i].checked) var idOrdenTecnica = document.getElementById(theForm).idOrdenTecnica[i].value;
	}

	window.open('informeTecnicoRPT.php?idOrdenTecnica='+idOrdenTecnica,'OrdenTecnicaRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500, left='+posicion_x+', top='+posicion_y+'');
}

function changePageConfirmaPagos(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;

	document.getElementById(theForm).submit();
}

function changePageFacturaPagos(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	document.getElementById(theForm).action = '';
	document.getElementById(theForm).target="_self";

	document.getElementById(theForm).submit();
}

function performConfirmaPagos(theForm) {
	check = confirm('¿Confirmar los pagos seleccionados?');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=confirmaPagosABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function performFacturaPagos(theForm) {
	check = confirm('¿Facturar los pagos seleccionados?');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=facturaPagosABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function performCierraBajaEfectiva(theForm) {
	 window.opener.location = 'main.php?accion=clientes';
	 window.close();
}

function performBajaProveedor(theForm) {
	check = confirm('Confirme la eliminacion del proveedor.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'proveedorABM.php';
		document.getElementById(theForm).submit();
	}
}


function changePageOT(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	//document.getElementById('filtro').value = filtro;
	document.getElementById(theForm).submit();
}

function changePageClienteConexion(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idClienteActivo.length == undefined) {
		document.getElementById(theForm).idClienteActivo.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idClienteActivo.length;i++){
			document.getElementById(theForm).idClienteActivo[i].value = -1;
		}
	}
	document.getElementById(theForm).submit();
}

function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

   return true;
}

function performViewRangosNodo(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=rangosNodo&folder=browse';
	document.getElementById(theForm).submit();
}

function performAltaRangoIP(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=rangoIpView&folder=views';
	document.getElementById(theForm).submit();
}

function performModRangoIP(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'main.php?accion=rangoIpView&folder=views';
	document.getElementById(theForm).submit();
}

function performBajaRangoIP(theForm) {
	check = confirm('Confirme la eliminacion del rango de IP.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=rangoIpABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function checkRangoIP(theForm) {
	// Validacion de campos obligatorios
	if ( (document.getElementById('ip_oct1').value == '')  ||
			(document.getElementById('ip_oct2').value == '') ||
			(document.getElementById('ip_oct3').value == '') ||
			(document.getElementById('ip_oct4_i').value == '') ||
			(document.getElementById('ip_oct4_f').value == '')
		){
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}

importePagosSel = 0;
function sumaPagosSeleccionados(cb, id, importe)
{
	if (cb.checked) {
		importePagosSel = importePagosSel + importe;
	} else {
		importePagosSel = importePagosSel - importe;
	}

	document.getElementById('totalSel').value = importePagosSel;
   return true;
}

function changePageDeuda(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;

	document.getElementById(theForm).submit();
}

function changePageOT(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;

	document.getElementById(theForm).submit();
}

cantOTSel = 0;
function sumaOTsSeleccionados(cb, id)
{
	if (cb.checked) {
		cantOTSel  = cantOTSel  + 1;
	} else {
		cantOTSel  = cantOTSel  - 1;
	}

	document.getElementById('totalSel').value = cantOTSel ;
   return true;
}

function performPrintDeudaGeneral(localidad, periodo, sort, order) {
	window.open('deudaGeneralRPT.php?loc='+localidad+'&per='+periodo+'&s='+sort+'&o='+order,'DeudaGeneralRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500');
}

function changePagePagosConfirmados(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	document.getElementById('order').value = order;

	document.getElementById(theForm).submit();
}

function submitFormOrder(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;

	if (order == 0) {
	  	order = 1;
	  } else {
		  if (order == 1) {
			  order = 0;
		  } else {
			  order = 0;
		  }
	  }

	document.getElementById('order').value = order;
	document.getElementById(theForm).submit();
}

function isValidKey(evt)
{
	tecla = (document.all) ? evt.keyCode : evt.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z��\w]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}

function changePageClienteReactivar(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	document.getElementById('order').value = order;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idCorte.length == undefined) {
		document.getElementById(theForm).idCorte.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idCorte.length;i++){
			document.getElementById(theForm).idCorte[i].value = -1;
		}
	}

	document.getElementById(theForm).submit();
}

function performReactivarCliente(theForm) {
	check = confirm('Confirme la Reactivacion del Cliente.');
	if (check) {
		document.getElementById('op').value = 'r';
		document.getElementById(theForm).action = 'clienteABM.php';
		document.getElementById(theForm).submit();
	}
}

function isValidKey(evt)
{
	tecla = (document.all) ? evt.keyCode : evt.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\w\r]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}

function performModFechaVencimientoPeriodos(theForm) {
	check = confirm('Esto modificara todos los vencimientos a partir del proximo mes. Confirme.');
	if (check) {
		document.getElementById('op').value = 'v';
		document.getElementById(theForm).action = 'periodoCalendarioABM.php';
		document.getElementById(theForm).submit();
	}
}

function performClientesCompartidos(theForm) {
	//limpio el campo de sort antes de pasar al abm de ubicaciones
	document.getElementById('sort').value = '';
	document.getElementById('pagsTotal').value = -1;
	document.getElementById('pagActual').value = -1;

	document.getElementById(theForm).action = 'main.php?accion=clientesCompartidos&folder=browse';
	document.getElementById(theForm).submit();
}

function performMarcarPrincipal(theForm) {
	check = confirm('Marcar los clientes seleccionados como principales.');
	if (check) {
		document.getElementById('op').value = 'a';
		document.getElementById(theForm).action = 'main.php?accion=clientesDispABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function performDesmarcarPrincipal(theForm) {
	check = confirm('Desmarcar los clientes seleccionados como principales.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'main.php?accion=clientesDispABM&folder=views';
		document.getElementById(theForm).submit();
	}
}

function performOpenRetirarDisp(theForm) {

	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(800/2);
	posicion_y=(screen.height/2)-(200/2);

	window.open('bajaClienteDispositivo.php?idCliente='+document.getElementById('idCliente').value+'&idDispositivo='+document.getElementById('idDispositivo').value+"&fechaBaja="+document.getElementById('fechaBaja').value+"&op=rd",'servicioView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=500, left='+posicion_x+', top='+posicion_y+'');

}

function performRetirarDispositivo(theForm) {

	if (document.getElementById('cant_clientes').value==1) {
		if (document.getElementById('c_id_localidad').value <= 0) {
			alert ("Debe seleccionar Localidad");
		} else {
			document.getElementById('op').value = 'rd';
			document.getElementById(theForm).action = 'clienteABM.php';
			document.getElementById(theForm).submit();
		}
	} else {
		document.getElementById('op').value = 'rd';
		document.getElementById(theForm).action = 'clienteABM.php';
		document.getElementById(theForm).submit();
	}
}

function performCierraRetirarDispositivo(theForm) {
	 window.opener.location = 'main.php?accion=clientesConexion';
	 window.close();
}

function performBackClientes(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=clientes';
	document.getElementById(theForm).submit();
}

function performViewBajas(theForm) {
	if (document.getElementById(theForm).idCliente.length == undefined) {
        if(document.getElementById(theForm).idCliente.checked) var idCliente = document.getElementById(theForm).idCliente.value;
	} else {
		for(i=0; i<document.getElementById(theForm).idCliente.length; i++)
			if(document.getElementById(theForm).idCliente[i].checked) var idCliente = document.getElementById(theForm).idCliente[i].value;
	}

	window.open('clienteBajas.php?id='+idCliente,'clienteBajas','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=500');
}

function performCloseClienteBajasView(theForm) {
	window.opener.location = 'main.php?accion=clientes';
	window.close();
}

function performPrintIncidenciasCerradas(fLocalidad, fUsuarioCierre, fNombre, fTema, fFechaInicio, fFechaFin, sort) {
	window.open('incidenciasCerradasRPT.php?loc='+fLocalidad+'&usr='+fUsuarioCierre+'&nom='+fNombre+"&tem="+fTema+"&fin="+fFechaInicio+"&ffi="+fFechaFin+"&s="+sort,'incidenciasCerradasRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500');
}

function performOpenModUserPass(theForm,origen) {
	var posicion_x;
	var posicion_y;
	var v_width=800;
	var	v_height=400;
	posicion_x=(screen.width/2)-(v_width/2);
	posicion_y=(screen.height/2)-(v_height/2);

	window.open('modificarUserPass.php?idCliente='+document.getElementById(theForm).idClienteActivo.value+"&origen="+origen,'cerrar','status=0,scrollbars=1,location=no,directories=0,resizable=0,menu=no,width='+v_width+',height='+v_height+', left='+posicion_x+', top='+posicion_y+'');
}

function performModUserPass(theForm) {
	document.getElementById('op').value = 'mup';
	document.getElementById(theForm).action = 'clienteABM.php';
	document.getElementById(theForm).submit();
}

function performCloseModUserPass(theForm,origen) {
	 window.opener.location = 'main.php?accion=cambiarDispView&idClienteActivo='+document.getElementById('idCliente').value+"&origen="+origen;;
	 window.close();
}

function performViewServiciosDeBaja(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=serviciosDeBaja';
	document.getElementById(theForm).submit();
}

function performFechaBajaServicio(theForm,idUser) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(300/2);
	posicion_y=(screen.height/2)-(300/2);

	check = confirm('Confirme la baja del servicio.');
	if (check) {
		window.open('servicioFechaBaja.php?ids='+document.getElementById('idServicio').value+'&idu='+idUser,'bajaServicio','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=300,height=300, left='+posicion_x+', top='+posicion_y+'');
	}
}

function performModBajaServicio(theForm,idUser) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(300/2);
	posicion_y=(screen.height/2)-(300/2);

	check = confirm('Confirme la modificacion de la fecha.');
	if (check) {
		if (document.getElementById(theForm).idServicio.length == undefined) {
	        if(document.getElementById(theForm).idServicio.checked) var idServicio = document.getElementById(theForm).idServicio.value;
		} else {
			for(i=0; i<document.getElementById(theForm).idServicio.length; i++)
				if(document.getElementById(theForm).idServicio[i].checked) var idServicio = document.getElementById(theForm).idServicio[i].value;
		}

		window.open('servicioFechaMod.php?ids='+idServicio+'&idu='+idUser,'bajaServicio','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=300,height=300, left='+posicion_x+', top='+posicion_y+'');
	}
}

function performModServicioFecha(theForm) {
	document.getElementById('op').value = 'f';
	document.getElementById(theForm).action = 'servicioABM.php';
	document.getElementById(theForm).submit();
}

function performCloseFechaModServicioView(theForm) {
	window.opener.location = 'main.php?accion=serviciosDeBaja';
	window.close();
}

function performPrintSalidaPC(theForm){
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(900/2);
	posicion_y=(screen.height/2)-(500/2);

	if (document.getElementById(theForm).idPosibleCliente.length == undefined) {
        if(document.getElementById(theForm).idPosibleCliente.checked) var idPosibleCliente = document.getElementById(theForm).idPosibleCliente.value;
	} else {
		for(i=0; i<document.getElementById(theForm).idPosibleCliente.length; i++)
			if(document.getElementById(theForm).idPosibleCliente[i].checked) var idPosibleCliente = document.getElementById(theForm).idPosibleCliente[i].value;
	}

	window.open('posibleClienteSalidaRPT.php?idPosibleCliente='+idPosibleCliente,'OrdenTecnicaRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500, left='+posicion_x+', top='+posicion_y+'');
}

function maximo(campo,limite){
	if(campo.value.length>=limite){
	campo.value=campo.value.substring(0,limite);
	 }
	}

function performViewPosiblesServicios(theForm) {
	if (document.getElementById(theForm).idPosibleCliente.length == undefined) {
        if(document.getElementById(theForm).idPosibleCliente.checked) var idPosibleCliente = document.getElementById(theForm).idPosibleCliente.value;
	} else {
		for(i=0; i<document.getElementById(theForm).idPosibleCliente.length; i++)
			if(document.getElementById(theForm).idPosibleCliente[i].checked) var idPosibleCliente = document.getElementById(theForm).idPosibleCliente[i].value;
	}

	document.getElementById(theForm).action = 'main.php?accion=posibleServicios&idPosibleCliente='+idPosibleCliente;
	document.getElementById(theForm).submit();
}

function performOpenPosibleServicios(theForm) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(800/2);
	posicion_y=(screen.height/2)-(500/2);

	window.open('posibleServicioView.php?idPosibleCliente='+document.getElementById('idPosibleCliente').value,'posibleServicioView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=500, left='+posicion_x+', top='+posicion_y+'');
}

function performBajaPosibleServicio(theForm) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(300/2);
	posicion_y=(screen.height/2)-(300/2);

	check = confirm('Confirme la eliminacion del servicio.');
	if (check) {
		if (document.getElementById(theForm).idServicio.length == undefined) {
	        if(document.getElementById(theForm).idServicio.checked) var idServicio = document.getElementById(theForm).idServicio.value;
		} else {
			for(i=0; i<document.getElementById(theForm).idServicio.length; i++)
				if(document.getElementById(theForm).idServicio[i].checked) var idServicio = document.getElementById(theForm).idServicio[i].value;
		}

		document.getElementById('op').value = 'b';
		document.getElementById('ids').value = idServicio;
		document.getElementById(theForm).action = 'posibleServicioABM.php';
		document.getElementById(theForm).submit();
	}
}

function performAltaPosibleServicio(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'posibleServicioABM.php';
	document.getElementById(theForm).submit();

}

function performClosePosServicioView(theForm,idPosibleCliente) {
	window.opener.location = 'main.php?accion=posibleServicios&idPosibleCliente='+idPosibleCliente;
	window.close();
}

function performBackPosibleClientes(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=posiblesClientes';
	document.getElementById(theForm).submit();
}

function performBackDeudaGeneral(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=deudaGeneral';
	document.getElementById(theForm).submit();
}

function performPagosAdelantados(theForm,pagoAdelantado) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(450/2);
	posicion_y=(screen.height/2)-(350/2);

    window.open('pagosAdelantadosCantidad.php?idc='+document.getElementById('idCliente').value+'&origen='+document.getElementById('origen').value+'&c_id_localidad='+document.getElementById('c_id_localidad').value+'&pagoAdelantado='+pagoAdelantado,'cantidadPeriodos','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=450,height=350, left='+posicion_x+', top='+posicion_y+'');

}

function performPagosAdelantadosCobrar(theForm) {
	document.getElementById(theForm).submit();
}

function performClosePagosAdelantadosCantidadView(theForm) {
	window.opener.location = 'main.php?accion=pagos&idCliente='+document.getElementById('idCliente').value+'&origen='+document.getElementById('origen').value;
	window.close();
}

function performLoginAgain() {
	window.opener.location = 'login.php';
	window.close();
}

function performViewClientesArticulo(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=clientesArticulo';
	document.getElementById(theForm).submit();
}

function changePageClienteArticulo(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	document.getElementById('order').value = order;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idCliente.length == undefined) {
		document.getElementById(theForm).idCliente.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idCliente.length;i++){
			document.getElementById(theForm).idCliente[i].value = -1;
		}
	}

	document.getElementById(theForm).submit();
}

function performOpenServiciosVariosClientes(theForm) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(800/2);
	posicion_y=(screen.height/2)-(500/2);

	//window.open('servicioVariosClientesView.php?idArticulo='+document.getElementById('idArticulo').value,'servicioViewVariosClientes','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=500, left='+posicion_x+', top='+posicion_y+'');
	window.open('', 'servicioViewVariosClientes','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=500, left='+posicion_x+', top='+posicion_y+'');

	document.getElementById(theForm).action = 'servicioVariosClientesView.php';
	document.getElementById(theForm).target='servicioViewVariosClientes';
	document.getElementById(theForm).submit();

}

function performCambiarServicioVariosClientes(theForm) {
	document.getElementById('op').value = 'c';
	document.getElementById(theForm).action = 'servicioABM.php';
	document.getElementById(theForm).submit();
}

function performCloseServicioVariosClientesView(theForm) {
	window.opener.location = 'main.php?accion=articulos';
	window.close();
}

function retiraDispositivo(theForm) {
	//a diferencia de performRetirarDispositivo, en este caso no interviene
	//nigun cliente, por lo que no se utiliza la mismma llamada a clienteABM que se utilizaba en la otra
	if  (document.getElementById('cambiaLoc').value <= 0) {
		alert ("Debe seleccionar Localidad");
	} else {
		if (confirm('Confirme el cambio de ubicacion del dispositivo.')) {
			document.getElementById('op').value = 'cu';
			document.getElementById(theForm).action = 'dispositivoABM.php';
			document.getElementById(theForm).submit();
		}
	}
}

function reporteDispPendientes(theForm) {
	document.getElementById(theForm).action = 'rpt/dispositivosPendientesRPT.php';
	document.getElementById(theForm).target="_blank";
	document.getElementById(theForm).submit();
}

function performViewProfiles(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=articuloProfile';
	document.getElementById(theForm).submit();
}

function performNuevoProfile(theForm) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(800/2);
	posicion_y=(screen.height/2)-(200/2);

	window.open('articuloProfileView.php?idArticulo='+document.getElementById('idArticulo').value+"&op=a",'articuloProfileView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=200, left='+posicion_x+', top='+posicion_y+'');
}

function performModificaProfile(theForm) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(800/2);
	posicion_y=(screen.height/2)-(200/2);


	if (document.getElementById(theForm).idProfile.length == undefined) {
	  if(document.getElementById(theForm).idProfile.checked)
		  var idProfile = document.getElementById(theForm).idProfile.value;
	  } else {
	    for(i=0; i<document.getElementById(theForm).idProfile.length; i++)
		  if(document.getElementById(theForm).idProfile[i].checked)
		    var idProfile = document.getElementById(theForm).idProfile[i].value;
	  }

	  window.open('articuloProfileView.php?idProfile='+idProfile+"&op=m",'articuloProfileView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=200, left='+posicion_x+', top='+posicion_y+'');
}

function performBajaProfile(theForm) {
	check = confirm('Confirme la eliminacion del Profile seleccionado.');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'articuloProfileABM.php';
		document.getElementById(theForm).submit();
	}
}

function performCloseProfileView(theForm) {
	 window.opener.location = 'main.php?accion=articuloProfile';
	 window.close();
}

function performAltaProfile(theForm) {
	document.getElementById('op').value = 'a';
	document.getElementById(theForm).action = 'articuloProfileABM.php';
	document.getElementById(theForm).submit();
}

function performModProfile(theForm) {
	document.getElementById('op').value = 'm';
	document.getElementById(theForm).action = 'articuloProfileABM.php';
	document.getElementById(theForm).submit();

}

function performModFechaIncomunicarPeriodos(theForm) {
	check = confirm('Esto modificara todos las fechas para incomunicar a partir del proximo mes. Confirme.');
	if (check) {
		document.getElementById('op').value = 'i';
		document.getElementById(theForm).action = 'periodoCalendarioABM.php';
		document.getElementById(theForm).submit();
	}
}

function performCambiaServicio(theForm,user,existeCambio) {
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(800/2);
	posicion_y=(screen.height/2)-(500/2);

	if (existeCambio==1) {
		alert ("Ya existe un Cambio de Servicio Pendiente de Cierre");
	} else {

		if (document.getElementById(theForm).idServicio.length == undefined) {
	        if(document.getElementById(theForm).idServicio.checked) var idServicio = document.getElementById(theForm).idServicio.value;
		} else {
			for(i=0; i<document.getElementById(theForm).idServicio.length; i++)
				if(document.getElementById(theForm).idServicio[i].checked) var idServicio = document.getElementById(theForm).idServicio[i].value;
		}

		window.open('servicioCambioView.php?id='+document.getElementById('idCliente').value+'&idServicioOld='+idServicio,'servicioCambioView','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=800,height=500, left='+posicion_x+', top='+posicion_y+'');7
	}
}

function performCambioServicio(theForm) {
	document.getElementById('op').value = 'cs';
	document.getElementById(theForm).action = 'servicioABM.php';
	document.getElementById(theForm).submit();

}

function performCambiarConexionCliente (theForm){
	document.getElementById(theForm).action = 'main.php?accion=cambiarDispView&c_id_cliente='+document.getElementById('idCliente').value+"&origen=CLIENTES";
	document.getElementById(theForm).submit();
}

function performCorregirConexionCliente (theForm){
	document.getElementById(theForm).action = 'main.php?accion=cambiarDispView&c_id_cliente='+document.getElementById('idCliente').value+"&origen=CORRIGE";
	document.getElementById(theForm).submit();
}

function changePageClienteConProblema(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	document.getElementById('order').value = order;
	//document.getElementById('filtro').value = filtro;
	if (document.getElementById(theForm).idCliente.length == undefined) {
		document.getElementById(theForm).idCliente.value = -1;
	} else {
		for (i=0;i<document.getElementById(theForm).idCliente.length;i++){
			document.getElementById(theForm).idCliente[i].value = -1;
		}
	}

	document.getElementById(theForm).submit();
}

function setImporteLiquida(theForm) {
	document.getElementById('i_liquidacion').value = ((document.getElementById('i_servicio').value * 100)/121).toFixed(2);
}

function changePageListadoPayU(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	document.getElementById('order').value = order;

	document.getElementById(theForm).submit();
}

function changePageClientePayU(theForm, sort, pagTotal, pagActual,order) {
	document.getElementById('sort').value = sort;
	document.getElementById('order').value = order;

	document.getElementById(theForm).submit();
}

function changePageClientePayUEnvio(theForm, sort, pagTotal, pagActual) {
	document.getElementById('sort').value = sort;

	document.getElementById(theForm).submit();
}

function performPayU(theForm,tipo) {
  if (tipo == 'M') {
	check = confirm('Confirme el Envio a PayU.');
	if (check) {
		document.getElementById('envio').style.visibility = "hidden";
		document.getElementById(theForm).action = 'clientesPayUABM.php';
		document.getElementById(theForm).submit();
	}
  } else {
	document.getElementById(theForm).action = 'clientesPayUABM.php';
	document.getElementById(theForm).submit();
  }

}

function clearFilterSinPaginado(theForm, sort, filterId, clearValue) {
	document.getElementById('sort').value = sort;
	document.getElementById(filterId).value = clearValue;
	document.getElementById(theForm).submit();
}

function changePagePayUVerPeriodo(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;

	document.getElementById(theForm).submit();
}

function performRegistrarPagosPayU(theForm,tipoRegistro){
	if (tipoRegistro == 'M'){
	  check = confirm('Confirma la registracion de/los pago/s seleccionado/s.');

	  if (check) {
		document.getElementById('op').value = 'ppu';
		document.getElementById(theForm).action = 'pagoConDetalleABM.php';
		document.getElementById(theForm).submit();
	  }
	} else {
		document.getElementById('op').value = 'ppu';
		document.getElementById(theForm).action = 'pagoConDetalleABM.php';
		document.getElementById(theForm).submit();
	}
}

function performVerificarPayU(theForm){
	document.getElementById('op').value = 'vdm';
	document.getElementById(theForm).action = 'main.php?accion=clientesPayUVerPeriodo';
	document.getElementById(theForm).submit();
}


function seleccionar_todo(form){
	 var formulario = eval(form)
	 for (var i=0, len=formulario.elements.length; i<len ; i++)
	  {
	    if ((formulario.elements[i].type == "checkbox" ) && (!(formulario.elements[i].disabled)))
	      formulario.elements[i].checked = 1
	  }
	}

function deseleccionar_todo(form){
		 var formulario = eval(form)
		 for (var i=0, len=formulario.elements.length; i<len ; i++)
		  {
		    if ( formulario.elements[i].type == "checkbox" )
		      formulario.elements[i].checked = 0
		  }
		}

function seleccionar_todo_confirma(form,total){
	 var formulario = eval(form)
	 for (var i=0, len=formulario.elements.length; i<len ; i++)
	  {
	    if ((formulario.elements[i].type == "checkbox" ) && (!(formulario.elements[i].disabled)))
	      formulario.elements[i].checked = 1
	  }

	 document.getElementById('totalSel').value = total;
}

function deseleccionar_todo_confirma(form){
		 var formulario = eval(form)
		 for (var i=0, len=formulario.elements.length; i<len ; i++)
		  {
		    if ( formulario.elements[i].type == "checkbox" )
		      formulario.elements[i].checked = 0
		  }

		 document.getElementById('totalSel').value = 0;
}

function performEstadUsuario(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=estadisticasUsuarios&folder=browse';
	document.getElementById(theForm).submit();
}
function changePageEstadUsr(theForm, sort, pagTotal, pagActual) {
	document.getElementById('pagsTotal').value = pagTotal;
	document.getElementById('pagActual').value = pagActual;
	document.getElementById('sort').value = sort;
	if (document.getElementById(theForm).idUsuario != undefined) {
		if  (document.getElementById(theForm).idUsuario.length == undefined) {
			document.getElementById(theForm).idUsuario.value = -1;
		} else {
			for (i=0;i<document.getElementById(theForm).idUsuario.length;i++){
				document.getElementById(theForm).idUsuario[i].value = -1;
			}
		}
	}
	document.getElementById(theForm).submit();
}

function performDetEstadUsuario(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=detEstadUsuario&folder=browse';
	document.getElementById(theForm).submit();
}

function performDetEstadPeriodo(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=detEstadPeriodo&folder=browse';
	document.getElementById(theForm).submit();
}

function performImprimirIncidencia(theForm){
	var posicion_x;
	var posicion_y;
	posicion_x=(screen.width/2)-(900/2);
	posicion_y=(screen.height/2)-(500/2);

	window.open('incidenciaRPT.php?idIncidencia='+document.getElementById(theForm).idIncidencia.value,'IncidenciaRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500, left='+posicion_x+', top='+posicion_y+'');
}

function performLiberaMAC(theForm) {
	check = confirm('Confirme la liberacion de la MAC.');
	if (check) {
		document.getElementById('op').value = 'lm';
		document.getElementById(theForm).action = 'dispositivoABM.php';
		document.getElementById(theForm).submit();
	}
}

function performEliminarOrden(theForm) {
	check = confirm('Desea ELIMINAR la Orden Tecnica');
	if (check) {
		document.getElementById('op').value = 'b';
		document.getElementById(theForm).action = 'ordenTecnicaABM.php';
		document.getElementById(theForm).submit();
	}
}

function changePageClienteMail(theForm) {
	document.getElementById(theForm).submit();
}

function clearFilterMail(theForm,filterId,clearValue) {
	document.getElementById(filterId).value = clearValue;
	document.getElementById(theForm).submit();
}

dirSeleccionadas = 0;
function sumaPagosSeleccionados(cb, id, importe)
{
	if (cb.checked) {
		dirSeleccionadas = dirSeleccionadas + importe;
	} else {
		dirSeleccionadas = dirSeleccionadas - importe;
	}

	document.getElementById('totalSel').value = dirSeleccionadas;
   return true;
}

function performEnvioMailPersonalizado(theForm){

	if (document.getElementById('d_asunto').value == '') {
	  alert('Falta el ASUNTO del mail a enviar');
	} else {
		if (document.getElementById('dMensaje').value == '') {
			alert('Falta el MENSAJE del mail a enviar');
		} else {
			document.getElementById('op').value = 'E';
			document.getElementById(theForm).action = 'main.php?accion=clientesEnvioMailPersonalizadoEnviar';
			document.getElementById(theForm).submit();
		}		
	}

}

function performViewDetalleTransaccion(c_id_transaccion_cab){
	document.getElementById('formClientesPayUVer').action = 'main.php?accion=clientesPayUVerTransaccionDetalle&idTransaccionCab='+c_id_transaccion_cab;
	document.getElementById('formClientesPayUVer').submit();
}

function performPayUVerPeriodo(theForm){
	document.getElementById(theForm).action = 'main.php?accion=clientesPayUVerPeriodo&op=T';
	document.getElementById(theForm).submit();
}

function performReenviarMailPayU(c_id_transaccion_cab){
	document.getElementById('formClientesPayUVer').action = 'main.php?accion=clientesPayUReenvioMail&idTransaccionCab='+c_id_transaccion_cab;
	document.getElementById('formClientesPayUVer').submit();
}

function performReenviarMailMasivoPayU(theForm){
	document.getElementById(theForm).action = 'main.php?accion=clientesPayUReenvioMailMasivo&op=T';
	document.getElementById(theForm).submit();
}

function reporteFacturaPagos(theForm) {
	document.getElementById(theForm).action = 'rpt/facturaPagosRPT.php';
	document.getElementById(theForm).target="_blank";
	document.getElementById(theForm).submit();
}


function performSeleccionClientes(theForm,idCliente) {
	document.getElementById(theForm).action = 'main.php?accion=clientesSeleccionAsociar&idClientePadre='+idCliente;
	document.getElementById(theForm).submit();
}

function performAsociarCliente(theForm) {
	document.getElementById(theForm).action = 'clienteABM.php';
	document.getElementById(theForm).submit();
}

function performViewServiciosHijo(theForm,idClienteRel) {

	document.getElementById(theForm).action = 'main.php?accion=servicios&idClienteHijo='+idClienteRel;
	document.getElementById(theForm).submit();
}

function performClientesAsociados(theForm) {
	document.getElementById(theForm).action = 'main.php?accion=clientesAsociados';
	document.getElementById(theForm).submit();

}

function performBajaClienteAsociado(theForm) {
	document.getElementById(theForm).action = 'clienteABM.php';
	document.getElementById(theForm).submit();
}

function exportFacturaPagos(theForm) {
	document.getElementById(theForm).action = 'export/facturaPagosEXP.php';
	document.getElementById(theForm).target="_blank";
	document.getElementById(theForm).submit();
}

function exportListadoPagos(theForm) {
	document.getElementById(theForm).action = 'export/listaPagosEXP.php';
	document.getElementById(theForm).target="_blank";
	document.getElementById(theForm).submit();
}

function performAltaMailSistema(theForm) {
	document.getElementById('op').value = 'a';
    document.getElementById(theForm).action = 'main.php?accion=mailSistemaView&folder=views';
	document.getElementById(theForm).submit();
}

function checkMailSistema(theForm) {
	// Validacion de campos obligatorios
	if ((document.getElementById('d_usuario_mail').value == '')) {
		alert('Ingrese un valor para los datos obligatorios.');
	} else {
		document.getElementById(theForm).submit();
	}
}