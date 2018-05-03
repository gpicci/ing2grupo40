<?php 
	require_once('../config.php');
	require_once('../db/db.php');
	$db = DB::singleton();
	
	$db->close();
?>
<html>
	<head>
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
					<form action="" method="post">		
					<fieldset>
						<legend>Su sesión ha caducado, vuelva a loguearse</legend>		
<?php
	if(isset($_REQUEST['loc']) AND ($_REQUEST['loc'] == 'popup')) {
?>
						<a href="javascript:performLoginAgain();">LOGIN</a></div>
<?php
	} else { 
?>
						<a href="login.php"><span>LOGIN</span></a>
<?php	} ?>
					</fieldset>
					</form>
				</div>
			</div>
		</div>
</body>
</html>