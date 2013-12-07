<?php

class indexController extends Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function index()
	{	
		$this->_view->assign('titulo','Bievenido al Framework CodeNeo V.00.1');
		$this->_view->renderizar('index');
	}
}
?>