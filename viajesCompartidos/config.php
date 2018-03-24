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

  /*DATOS PARA PAYU PRUEBA*/
  /*define("PAYU_APIKEY","4Vj8eK4rloUd272L48hsrarnUA");
  define("PAYU_MERCHANTID","508029");
  define("PAYU_ACCOUNTID","512322");
  define("PAYU_LINK","http://localhost/lewtel/");
  define("PAYU_TEST","1");
  define("PAYU_ACTION","https://gateway.payulatam.com/ppp-web-gateway/");*/

  /*DATOS PARA PAYU PRODUCCION*/
  define("PAYU_APILOGIN","7aaa154f2ab8b90");
  define("PAYU_APIKEY","7fg8hbanivc42p56q3q541a6b8");
  define("PAYU_MERCHANTID","522444");
  define("PAYU_ACCOUNTID","524072");
  define("PAYU_LINK","http://www.sistemapatagon.com.ar/");
  define("PAYU_TEST","0");
  define("PAYU_ACTION","https://gateway.payulatam.com/ppp-web-gateway/");

  /*DATOS PARA FW*/
  define("FWIP","190.220.23.1");


?>