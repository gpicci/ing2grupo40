<?php
	ob_start();
	require_once("db/usuarioDB.php");

	$db = DB::singleton();
	
	$nombreUsuario = "USUARIO: ".$_SESSION['nombre_usuario'];
	
	/*if (getConsultaAlertas()>0) {
		$hasAlerta=TRUE;
	} else{
		$hasAlerta= FALSE;
	}

	if ($hasAlerta) {
		echo "<div style=\"background: #AA7474;\"id=\"header\">";
	} else {
		echo "<div id=\"header\">";	
	}*/

?>
<body>	
	<p id="alignleft"><?php print(VIEW_PAGE_TITLE.' - '.VIEW_EMPRESA); ?></p>
	<p id="alignright"><?php print($nombreUsuario);?>
	<?php
	/*	if ($hasAlerta) {
			echo " [Incidencias asignadas]";
		}*/ 
	?>
	</p>
	</div>	
	<div>				
		<ul id="css3menu1" class="topmenu"> 
			<?php if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CONFIGURACION')) { ?>
				<li class="topfirst"><a href="#" style="height:18px;line-height:18px;"><span>CONFIGURACION</span></a>
				<ul>
			<?php		if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'LOCALIDAD')) { ?>
								<li><a href="main.php?accion=localidad&folder=<?php print(ABM_BROWSE_DIR); ?>">LOCALIDAD</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CALLE')) { ?>
								<li><a href="main.php?accion=calles&folder=<?php print(ABM_BROWSE_DIR); ?>">CALLE</a></li>
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'TEMA')) { ?>
								<li><a href="main.php?accion=temas_inc&folder=<?php print(ABM_BROWSE_DIR); ?>">TEMA INCIDENCIA</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'ARTICULO')) { ?>
								<li><a href="main.php?accion=articulos">ARTICULO</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'TIPODISP')) { ?>
								<li><a href="main.php?accion=tiposDispositivos">TIPO DISPOSITIVO</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'TIPOAP')) { ?>
								<li><a href="main.php?accion=tiposAPs">TIPO AP</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'MOTIVO')) { ?>
								<li><a href="main.php?accion=motivosCorte">MOTIVO CORTE</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'PROVEEDOR')) { ?>
								<li><a href="main.php?accion=proveedores">PROVEEDOR</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'ACCESORIO')) { ?>
								<li><a href="main.php?accion=accesoriosChequeos">ACCESORIO CHEQUEO</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'VENCIMIENTOPERIODOS')) { ?>
								<li><a href="main.php?accion=periodoCalendarioView">FECHAS PERIODOS</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CONFIGURACION')) { ?>
								<li><a href="main.php?accion=mailSistema&folder=<?php print(ABM_BROWSE_DIR); ?>">MAIL DE SISTEMA</a></li>
			<?php 	} ?>
							</ul>
						</li>
			<?php } ?>
			
			<?php	if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'TECNICA')) { ?> 
						<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>TECNICA</span></a>
							<ul>
			<?php		if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'DISPOSITIVO')) { ?>
								<li><a href="main.php?accion=dispositivos">DISPOSITIVO</a></li>
			<?php	}	if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'DISPPENDDEV')) { ?>
								<li><a href="main.php?accion=dispositivosPendientes">DISPOSITIVOS PENDIENTES DEVOLUCION</a></li>
			<?php	}	if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'DISPPENDDEV')) { ?>
								<li><a href="main.php?accion=dispositivosBajaMAC">DISPOSITIVOS DADOS DE BAJA</a></li>					
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'DISPPENDDEV')) { ?>
								<li><a href="main.php?accion=clientesConProblemaDeDispositivo">CLIENTES CON PROBLEMAS DE DISPOSITIVO</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'NODO')) { ?>
								<li><a href="main.php?accion=nodos">NODO</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'AP')) { ?>
								<li><a href="main.php?accion=aps">ACESS POINT</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'GENERAR')) { ?>
								<li><a href="main.php?accion=ordenTecnicaGenerar">GENERAR ORDEN TECNICA</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CERRAR')) { ?>
								<li><a href="main.php?accion=ordenTecnicaCerrar">CERRAR/MODIFICAR ORDEN TECNICA</a></li>
			<?php 	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CONEXION')) { ?>
								<li><a href="main.php?accion=clientesConexion">DATOS DE CONEXION</a></li>
			<?php 	} ?>
							</ul>
						</li>
			<?php } ?>
			
			<?php	if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'ADMINISTRACION')) { ?> 
						<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>ADMINISTRACION</span></a>
							<ul>
			<?php		if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'POSIBLE')) { ?>
								<li><a href="main.php?accion=posiblesClientes">POSIBLE CLIENTE</a></li>
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CLIENTE')) { ?>
								<li><a href="main.php?accion=clientes">CLIENTE</a></li>			
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CLIENTE')) { ?>
							  <li><a href="main.php?accion=clientesSinMail">CLIENTE SIN MAIL</a></li>										  									
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CLIENTEREACTIVAR')) { ?>
								<li><a href="main.php?accion=clientesReactivar">REACTIVAR CLIENTE</a></li>
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CONFIRMAORDEN')) { ?>
								<li><a href="main.php?accion=ordenTecnicaConfirmar">CONFIRMAR ORDEN TECNICA</a></li>
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CONFIRMAPAGO')) { ?>
								<li><a href="main.php?accion=confirmaPagos&folder=<?php print(ABM_BROWSE_DIR); ?>">CONFIRMAR PAGOS</a></li>
		    <?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CONFIRMAPAGO')) { ?>
								<li><a href="main.php?accion=listadoPagos&folder=<?php print(EXP_BROWSE_DIR); ?>">LISTADO DE PAGOS</a></li>											
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'FACTURAPAGO')) { ?>
								<li><a href="main.php?accion=facturaPagos&folder=<?php print(ABM_BROWSE_DIR); ?>">FACTURAR PAGOS</a></li>								
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CONFIRMADO')) { ?>
								<li><a href="main.php?accion=verPagosConfirmados&folder=<?php print(ABM_BROWSE_DIR); ?>">VER PAGOS CONFIRMADOS</a></li>
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'DEUDAGRAL')) { ?>
								<li><a href="main.php?accion=deudaGeneral">DEUDA GENERAL</a></li>		
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'MAILPERSONAL')) { ?>
								<li><a href="main.php?accion=clientesEnvioMailPersonalizado">ENVIO MAIL</a></li>									
			<?php 	} ?>
							</ul>
						</li>
			<?php } ?>
			
			<?php	if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CLIENTESPAYU')) { ?>
						<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>PAYU</span></a>
							<ul>
			<?php		if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CLIENTESPAYU')) { ?>
								<li><a href="main.php?accion=clientesPayU">CLIENTE CON PAYU</a></li>	
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'ENVIAPAYU')) { ?>
								<li><a href="main.php?accion=clientesPayUEnvio">ENVIAR PERIODO POR PAYU</a></li>		
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'PERIODOPAYU')) { ?>
								<li><a href="main.php?accion=clientesPayUVerPeriodo&op=T">VER PERIODO POR PAYU</a></li>		
			<?php 	} ?>
							</ul>
						</li>
			<?php } ?>
			
			<?php if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'USUARIOS')) { ?>
						<li class="topmenu"><a href="main.php?accion=usuarios&folder=<?php print(ABM_BROWSE_DIR); ?>" style="height:18px;line-height:18px;">USUARIO</a></li>
			<?php } ?>
			
			<?php if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'INCIDENCIA')) { ?>
						<li class="topmenu"><a href="#" style="height:18px;line-height:18px;">INCIDENCIAS</a>
							<ul>
			<?php		if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'INCIDENCIA')) { ?>
								<li><a href="main.php?accion=incidencias&folder=<?php print(ABM_BROWSE_DIR); ?>">ABIERTAS</a></li>
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'INCIDENCIA')) { ?>
								<li><a href="main.php?accion=incidenciasCerradas&folder=<?php print(ABM_BROWSE_DIR); ?>">CERRADAS</a></li>
			<?php 	}  if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'INCIDENCIA')) { ?>
								<li><a href="main.php?accion=incidenciasPropias&folder=<?php print(ABM_BROWSE_DIR); ?>">PROPIAS</a></li>
			<?php 	} ?>
							</ul>
						</li>
			<?php } ?>
			
			<?php if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'INCIDENCIANODO')) { ?>
						<li class="topmenu"><a href="#" style="height:18px;line-height:18px;">INC. NODOS</a>
							<ul>
			<?php		if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'INCIDENCIANODO')) { ?>
								<li><a href="main.php?accion=incidencias&tipoIncidencia=1&folder=<?php print(ABM_BROWSE_DIR); ?>">ABIERTAS</a></li>
			<?php		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'INCIDENCIANODO')) { ?>
								<li><a href="main.php?accion=incidenciasCerradas&tipoIncidencia=1&folder=<?php print(ABM_BROWSE_DIR); ?>">CERRADAS</a></li>
			<?php 	} ?>
							</ul>
						</li>
			<?php } ?>
			
			<?php if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'REPORTES')) { ?>
						<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>REPORTES</span></a>
							<ul>
			<?php		if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'DEUDA_LOCALIDAD')) { ?>
								<li><a href="javascript:void window.open('deudaLocalidadRPT.php','DeudaLocalidadRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500');">DEUDA POR LOCALIDAD</a></li>
			<?php		/*} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'DEUDA_PERIODO')) { ?>
								<li><a href="javascript:void window.open('deudaPeriodoRPT.php','DeudaPeriodoRPT','status=0,scrollbars=1,location=0,directories=0,resizable=0,menu=no,width=900,height=500');">DEUDA POR PERIODO</a></li>
			<?php 	*/	} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CLIENTEMES_OLD')) { ?>
								<li><a href="main.php?accion=listadoClientesMes&folder=<?php print(VIEWS_DIR); ?>">CLIENTES POR MES/SIN IVA VIEJO</a></li>
			<?php 		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'CLIENTE_MES')) { ?>
								<li><a href="main.php?accion=listadoClientesMesLiquida&folder=<?php print(VIEWS_DIR); ?>">CLIENTES POR MES/SIN IVA</a></li>
			<?php 		} if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'ESTADISTICAS')) { ?>
								<li><a href="main.php?accion=estadisticasPorMes&folder=<?php print(ABM_BROWSE_DIR); ?>">ESTADISTICAS POR MES</a></li>
			<?php 		} ?>
							</ul>
						</li>
			<?php } ?>
						
			
			<?php if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'PROGRAMADOR')) { ?>
						<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>PROGRAMADOR</span></a>
							<ul>
			<?php		if (rolUsuarioAccesoMenu($_SESSION["id_rol"], 'PROCINCOMUNICA')) { ?>
							  <li><a href="main.php?accion=procesoMailDeudaClientes">PROCESO ENVIO MAIL DEUDA</a></li>
								<li><a href="main.php?accion=procesoIncomunicarClientes">PROCESO INCOMUNICAR CLIENTES</a></li>
								<li><a href="main.php?accion=clientesIncomunicadosMikrotik">PROCESO ELIMINAR INCOMUNICADOS</a></li> 					
								<li><a href="main.php?accion=clientesIncomunicadosSinReactiva">CLIENTES INCOMUNICADOS SIN REACTIVAR</a></li>
								<li><a href="main.php?accion=clientesIncomunicadosMikrotik">REMOVER CLIENTES INCOMUNICADOS</a></li>										
								<li><a href="main.php?accion=setConfiguracion">SETEAR CONFIGURACION</a></li>	
								<li><a href="main.php?accion=envioMailPrueba">MAIL</a></li>		
								<li><a href="main.php?accion=pruebaEnvioMail">MAIL MANUAL</a></li>		
								<li><a href="info.php">INFO</a></li>
			<?php 		} ?>					
							</ul>				
						</li>
			<?php } ?>
			
			
						<li class="toplast"><a href="logout.php" style="height:18px;line-height:18px;">SALIR</a></li>
					</ul>  
				</div>
								
	<div><p></div>	