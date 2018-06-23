include db;

function yaExisteCorreo($correo, $id){
	$db = DB::singleton();
	$query= "SELECT COUNT(*) AS 'cant'
			FROM usuario
			WHERE correo_electronico= $correo
			AND usuario_id <> $id";
	$rs = $db->executeQuery($query);
	$row = $db->fetch_assoc($rs);
	$sum= $row['cant'];
	echo $sum;
	if ( $row['cant'] == 0 ) {
		return false;
	} else {
		return true;
	}
}