<?php

/*
	Framework NeoApp v.000.1
	esteban.programador@gmail.com
	Controller.php
*/

abstract class Controller
{
	private $_registry;
	protected $_view;
	protected $_request;
	public function __construct(){
		$this->_registry=Registry::getInstancia();
		$this->_request=$this->_registry->_request;
		$this->_view=new View($this->_request);
	}
	abstract public function index();

	/**
	 * Carga el modelo haciendo un "require_once (nameModel.php)"
	 * @param  [type] $modelo [nombre del modelo a cargar]
	 * @return [type]         [Incluye el modelo mostrando y cargando las variables]
	 */
	protected function loadModel($modelo)
	{
		$modelo=$modelo.'Model';
		$rutaModelo=ROOT.'models'.DS.$modelo.'.php';

		if(is_readable($rutaModelo)){
			require_once $rutaModelo;
			$modelo=new $modelo;
			return $modelo;
		}else{
			throw new Exception("Error en el modelo $modelo", 1);		
		}
	}


	protected function getLibrary($libreria)
	{
		$rutaLibreria=ROOT.'libs'.DS.$libreria.'.php';
		if(is_readable($rutaLibreria)){
			require_once $rutaLibreria;
		}else{
			throw new Exception("Error al cargar la libreria ".$libreria, 1);
		}
	}

	protected function getTexto($clave)
	{
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave]=htmlspecialchars($_POST[$clave],ENT_QUOTES);
			return $_POST[$clave];
		}

		return '';
	}

	protected function getInt($clave)
	{
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave]=filter_input(INPUT_POST,$clave,FILTER_VALIDATE_INT);
			return $_POST[$clave];
		}

		return 0;
	}

	protected function redireccionar($ruta=false)
	{
		if($ruta){
			header('location: '. BASE_URL.$ruta);
			exit;
		}else{
			header('location: '.BASE_URL);
			exit;
		}
	}

	protected function filtrarInt($int)
	{
		$int=(int) $int;

		if(is_int($int)){
			return $int;
		}else{
			return 0;
		}
	}

	protected function getPostParam($clave){
		if(isset($_POST[$clave])){
			return $_POST[$clave];
		}
	}

	protected function getSql($clave){
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave]=strip_tags($_POST[$clave]);
		}

		if(!get_magic_quotes_gpc()){
			$_POST[$clave]=mysql_escape_string($_POST[$clave]);
		}

		return trim($_POST[$clave]);
	}

	protected function getAlphaNum($clave){
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave]=(string)preg_replace('/[^A-Z0-9_]|/i','', $_POST[$clave]);
			return $_POST[$clave];
		}
	}

	public function validarEmail($email)
	{
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			return false;
		
		return true;		
	}

	/**
	 * Funcion que nos devuelve el tiempo transcurrido (humano)
	 * @param  [int] $time [tiempo en formato unix usando strtotime()]
	 * @return [string]       [tiempo transcurrido]
	 */
	public function timeago($time) {
		define("SECOND", 1);
	    define("MINUTE", 60 * SECOND);
	    define("HOUR", 60 * MINUTE);
	    define("DAY", 24 * HOUR);
	    define("MONTH", 30 * DAY);
            $delta = time() - $time;
    
            if ($delta < 1 * MINUTE)
            {
                    return $delta == 1 ? "en este momento" : "hace " . $delta . " segundos ";
            }
            if ($delta < 2 * MINUTE)
            {
                    return "hace un minuto";
            }
            if ($delta < 45 * MINUTE)
            {
                    return "hace " . floor($delta / MINUTE) . " minutos";
            }
            if ($delta < 90 * MINUTE)
            {
                    return "hace una hora";
            }
            if ($delta < 24 * HOUR)
            {
                    return "hace " . floor($delta / HOUR) . " horas";
            }
            if ($delta < 48 * HOUR)
            {
                    return "ayer";
            }
            if ($delta < 30 * DAY)
            {
                    return "hace " . floor($delta / DAY) . " dias";
            }
            if ($delta < 12 * MONTH)
            {
                    $months = floor($delta / DAY / 30);
                    return $months <= 1 ? "el mes pasado" : "hace " . $months . " meses";
            }
            else
            {
                    $years = floor($delta / DAY / 365);
                    return $years <= 1 ? "el a&ntilde;o pasado" : "hace " . $years . " a&ntilde;os";
            }
    
    }

    /**
     * Limpia titulos por url limpias para guardarlos como vinculos
     * @param  [string] $str [le pasamos un texto y lo convertira en url]
     * @return [string]      [description]
     */
    function makeUrl($str) {
		//Quitar tildes y ñ
		$tildes = array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ');
		$vocales = array('a','e','i','o','u','n','A','E','I','O','U','N');
		$str = str_replace($tildes,$vocales,$str);
	 
		//Quitar símbolos
		$simbolos = array("=","¿","?","¡","!","'","%","$","€","(",")","[","]","{","}","*","+","·",".","&lt; ","&gt;");
		$i = 0;
		while($simbolos[$i]){
		$str = str_replace($simbolos[$i], "", $str);
		$i++;
		}
	 
		//Quitar espacios
		$str = str_replace(" ","_",$str);
	 
		//Pasar a minúsculas
		$str = strtolower($str);
	 
		return $str;
	}

}//end Class
?>