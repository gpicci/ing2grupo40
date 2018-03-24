<?php
date_default_timezone_set("America/Argentina/Buenos_Aires");
  /*DATOS PARA CONEXION*/
  define("DB_CONN_HOSTNAME", 'localhost');
  define("DB_CONN_USER", 'danielj4_ispweb');
  define("DB_CONN_PASS", 'Metler2011');
  define("DB_CONN_DB", 'danielj4_ispweb');

  /*DATOS PARA LOG*/
  define("LOGFILE", 'app.log');
  define("LOGFILEMKT", 'mkt.log');
  define("LOGCONFPAYU", 'confirmationPayULog.log');
  define("LOGFILEBS", 'bs.log');

  /*DATOS PARA ENCABEZADO*/
  define("VIEW_PAGE_TITLE", 'INTERNET SERVICE PROVIDER MANAGER');
  define("VIEW_EMPRESA", 'PATAGON DIGITAL');

  /*DATOS PARA USO*/
  define("RECS_PER_PAGE", 10);
  define("CANTIDAD_REGISTROS_MAIL", 50);
  define("SESSION_INACTIVE_TIME_LIMIT", 600);
  define("USUARIO_PROCESO_AUTOMATICO", 7);
  define("ID_CARGO_EXTRAORDINARIO", 10);
  define("APLICACION_EN_MODO_DEBUG",true);
  define("ID_LOCALIDAD_DEFAULT",1);
  define("PAGINAOFICIAL", "http://www.patagondigital.com.ar");

  /*DATOS PARA NAVEGACION*/
  define("DB_DIR", "db");
  define("VIEWS_DIR", "views");
  define("ABM_DIR", "views");
  define("ABM_BROWSE_DIR", "browse");
  define("COM_DIR", "common");
  define("EXP_BROWSE_DIR", "export");


?>