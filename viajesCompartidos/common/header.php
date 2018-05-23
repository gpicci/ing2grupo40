<?php
ob_start();
require_once("db/usuarioDB.php");

$db = DB::singleton();

$nombreUsuario = "USUARIO: ".$_SESSION['nombre_usuario'];

//echo "<div id=\"header\">";
?>
<body>
	<div id="header">
	<p id="alignleft"><?php print(VIEW_PAGE_TITLE.' - '.VIEW_EMPRESA); ?></p>
	<p id="alignright"><?php print($nombreUsuario);?>
	</p>
	</div>
	<div style="background: #7dbde9;">
		<ul id="css3menu1" class="topmenu">
			<li class="topfirst"><a href="#" style="height:18px;line-height:18px;"><span>USUARIO</span></a>
				<ul>
					<li><a href="main.php?accion=usuarioView&op=m&folder=<?php print(VIEWS_DIR); ?>">MI PERFIL</a></li>
				</ul>
			</li>
			<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>VEHICULOS</span></a>
				<ul>
					<li><a href="main.php?accion=vehiculoView&op=a&folder=<?php print(VIEWS_DIR); ?>">AGREGAR VEHICULO</a></li>
					<li><a href="main.php?accion=vehiculos&folder=<?php print(BROWSE_DIR); ?>">LISTADO DE VEHICULOS</a></li>
				</ul>
			</li>
			<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>VIAJES PROPIOS</span></a>
				<ul>
					<li><a href="main.php?accion=viajeView&op=a&folder=<?php print(VIEWS_DIR); ?>">AGREGAR VIAJE</a></li>
					<li><a href="main.php?accion=viajes&folder=<?php print(BROWSE_DIR); ?>">LISTADO DE VIAJES</a></li>
				</ul>
			</li>
			<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>VIAJES</span></a>
				<ul>
					<li><a href="main.php?accion=viajes&propios=0&folder=<?php print(BROWSE_DIR); ?>">VIAJES DE OTROS</a></li>
				</ul>
			</li>
			<li class="toplast"><a href="logout.php" style="height:18px;line-height:18px;">CERRAR SESION</a></li>
		</ul>
	</div>
	<div><p></div>