<?php

/**
 * ===================================================
 * 			   CONFIGURACION DEL SITIO
 * ===================================================
 */

/* Parametros de Url y Router */
//dejar vacio  si usas URL_AMIGABLE || index.php/
define('URL_INDEX', 'index.php/'); 		
//tu web http://tusitio.com/path/ para los js,css,img
define('SITE_URL','http://localhost/codeneo/');
//sirve para los controladores,soporta si no tienes .htaccess
define('BASE_URL',SITE_URL.URL_INDEX); 
/*
	Sirve para la ruta de archivos publicos
 */
define('PUBLIC',SITE_URL.'public');
define('DEFAULT_CONTROLLER','index'); //controlador por defecto Index

//template por defecto ,bootstrap,default,etc. |default - bootstrap v.3.00|
define('DEFAULT_LAYOUT', 'bootstrap'); 
//activar si tienes habilitado el mod_rewrite
define('URL_AMIGABLE',false);


/* Parametros de Aplicacion */

define('APP_NAME', 'Framework CodeNeo V.001.1'); //nombre de tu aplicacion
define('APP_SLOGAN', 'Framework App Neo'); //nombre de slogan de la web

//nombre de la empresa
define('APP_COMPANY', 'http://your_domain.com'); 

//tiempo limite de una session de usuario <bool Session:acceso($level)> | 0 = no expira
define('SESSION_TIME', 0);  
/**
 * Uso de la encriptacion Hash::getHash('sha1',$your_password,HASH_KEY)
 * [Algoritmo][Password][GLOBAL::HAS_KEY]
 * KEY para la clave encritada en "sha1" -> default = 529b6ccf595d9
 */
define('HASH_KEY', '529b6ccf595d9'); 


/**
 * ===================================================
 * 		   CONFIGURACION DE LA BASE DE DATOS
 * ===================================================
 */

define('DB_ACTIVE',false);		//si se esta usando la database | default off=false | usar=true
define('DB_HOST','localhost');  //host del server database
define('DB_USER','root');		//usuario del server database
define('DB_PASS','123');		//password de la database
define('DB_NAME','dbname');		//nombre de la database
define('DB_CHAR','utf8');		//formato de registro database


?>