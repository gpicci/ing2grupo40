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