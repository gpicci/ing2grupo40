<?php

require_once("common/utilLogin.php");

$error=null;

if(isset($_POST['Ingresar']))	{
  $error=realizarLogin($_POST['username'], $_POST['password'], 'inicio');
} elseif(isset($_POST['Registrarse'])){
  $error=realizarLogin('registro', 'tlccae2018', 'usuarioView&folder=views&op=a');
}

?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
		<title><?php print(VIEW_PAGE_TITLE); ?></title>
		<link rel="stylesheet" type="text/css" href="./css/form.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="./css/general.css" media="screen" />
		<script type='text/javascript' src='js/isp.js'></script>
	</head>
	<body>
		<div id="header">
			<p id="alignleft">Bienvenido</p>
		</div>
		<div id="content">
			<div id="right">
				<div class="form-container">
<?php if(isset($error)) { ?>
					<div class="errors">
						<p><em><?php echo $error; ?></em></p>
					</div>
<?php } ?>
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

					<fieldset>
						<legend>Ingrese sus datos para comenzar.</legend>
						<div><label for="username">Mail</label><input type="text" id="username" name="username" value="" /></div>
						<div><label for="password">Password</label><input onkeypress="return isValidKey(event)"  type="password" id="password" name="password" value="" /></div>
					</fieldset>
					<div class="buttonrow">
						<input type="submit" name="Ingresar" value="Ingresar" class="button" />
						<input type="submit" name="Registrarse" value="Registrarse" class="button" />
					</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>