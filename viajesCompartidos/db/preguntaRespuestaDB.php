<?php
include_once($_SERVER['DOCUMENT_ROOT']."/viajes/db/db.php");
//drequire_once('./common/log.php');

function getPreguntasRespuestasViajeID(
  $idViaje) {
  $db = DB::singleton();

  $query = "SELECT
		p.pregunta_respuesta_id,
	p.viaje_id,
	p.usuario_id,
	p.anotacion,
	p.pregunta_original_id,
	CASE WHEN d_tipo = 'P' THEN CONCAT(u.nombre,' ',u.apellido) ELSE '' END AS d_nombre_usuario,
	p.d_tipo,
    (select count(1) from pregunta_respuesta r where r.pregunta_original_id = p.pregunta_respuesta_id) as n_tiene_respuesta
  FROM
    pregunta_respuesta p,
	usuario u
  WHERE p.usuario_id = u.usuario_id
  AND	viaje_id = ".$idViaje. "
  ORDER BY
	IFNULL(pregunta_original_id,pregunta_respuesta_id),
	pregunta_respuesta_id
	";

  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

function altaPregunta(
  $idViaje,
  $idUsuario,
  $pregunta) {

  $db = DB::singleton();

  $query = "
  INSERT INTO pregunta_respuesta (
    viaje_id,
	d_tipo,
	usuario_id,
	anotacion)
  VALUES ("
	.$idViaje.",
	'P',".
	$idUsuario.",'".
	$pregunta."')";

  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

function altaRespuesta(
  $idPregunta,
  $idViaje,
  $idUsuario,
  $respuesta) {

  $db = DB::singleton();

  $query = "
  INSERT INTO pregunta_respuesta (
	viaje_id,
	d_tipo,
	usuario_id,
	anotacion,
	pregunta_original_id)
  VALUES ("
	.$idViaje.",
	'R',"
	.$idUsuario.",'"
	.$respuesta."',"
	.$idPregunta.")";

	$rs = $db->executeQuery($query);

	if (!$rs) {
	  applog($db->db_error(), 1);
	}

	return $rs;
}

function getPreguntaById(
  $idPregunta) {

  $db = DB::singleton();

  $query = "
  SELECT
    anotacion,
	d_tipo
  FROM
    pregunta_respuesta
  WHERE pregunta_respuesta_id = ".$idPregunta;

  $rs = $db->executeQuery($query);

  if (!$rs) {
	applog($db->db_error(), 1);
  }

  return $rs;
}

?>