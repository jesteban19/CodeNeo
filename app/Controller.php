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
			throw new Exception("Error al cargar la libreria ".$librera, 1);
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
}
?>