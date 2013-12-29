<?php

/*
	Framework NeoApp v.000.1
	esteban.programador@gmail.com
	Model.php
*/

class Model
{
	private $_registry;
	protected $_db;
	
	public function __construct(){
		$this->_registry=Registry::getInstancia();
		$this->_db=$this->_registry->_db;
	}

	/**
	 * [getColumn Devuelve nombre de las columnas seleccionada mendiante el query]
	 * @param  [type] $sql    [query - sql ]
	 * @param  [type] $params [parametros]
	 * @return [type]         [description]
	 */
	public function getColumn($sql, $params)
	{
	    $stmt = $this->_db->prepare($sql);
	    $stmt->execute($params);
    	return $stmt->fetchColumn();
	}

	/**
	 * [simpleQuery funcion para arma una sentencia con parametros]
	 * @param  [type] $array [recibe un array con el objectos [sql],[par],[ret] resultado]
	 * @return [object]        [fetch-assoc | fetch-all | res]
	 */
    public function simpleQuery($array)
    {
        # Managing passed vars
        $sql = $array['sql'];
        $par = (isset($array['par'])) ? $array['par'] : array();
        $ret = (isset($array['ret'])) ? $array['ret'] : 'res';

        # Executing our query
        $obj = $this->db->prepare($sql);
        $result = $obj->execute($par);

        # What do you want me to return?
        switch ($ret)
        {
            case 'obj':
            case 'object':
                return $obj;
            break;

            case 'ass':
            case 'assoc':
            case 'fetch-assoc':
                return $obj->fetch(PDO::FETCH_ASSOC);
            break;

            case 'all':
            case 'fetch-all':
                return $obj->fetchAll();
            break;

            case 'res':
            case 'result':
                return $result;
            break;

            default:
                return $result;
            break;
        }
    }
}
?>