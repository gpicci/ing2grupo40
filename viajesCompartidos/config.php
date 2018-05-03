<?php
date_default_timezone_set("America/Argentina/Buenos_Aires");
  /*DATOS PARA CONEXION*/
  define("DB_CONN_HOSTNAME", 'localhost');
  define("DB_CONN_USER", 'viajes');
  define("DB_CONN_PASS", 'viajes');
  define("DB_CONN_DB", 'viajes');

  /*DATOS PARA LOG*/
  define("LOGFILE", 'app.log');

  /*DATOS PARA ENCABEZADO*/
  define("VIEW_PAGE_TITLE", 'VIAJES COMPARTIDOS');
  define("VIEW_EMPRESA", 'VIAJES COMPARTIDOS');

  /*DATOS PARA USO*/
  define("RECS_PER_PAGE", 10);
  define("CANTIDAD_REGISTROS_MAIL", 50);
  define("SESSION_INACTIVE_TIME_LIMIT", 600);

  /*DATOS PARA NAVEGACION*/
  define("DB_DIR", "db");
  define("VIEWS_DIR", "views");
  define("ABM_DIR", "views");
  define("ABM_BROWSE_DIR", "browse");
  define("COM_DIR", "common");
  define("EXP_BROWSE_DIR", "export");


?>