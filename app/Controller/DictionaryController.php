<?php
use bayon\core\Controller;

class DictionaryController extends Controller{
	var $uses=array('Dictionary');

	function before($action=''){

	}

	/**
	 * Пример метода в контроллере
	 */
	function index(){
		$this->set('start','hello world!');
	}

    /**
     * Получение данных из словаря
     */
    function getDictionaryValues($dict_name)
    {
        $result = '';
        if($dict_name<>'') {
            $result = $this->Dictionary->getDictionaryValues($dict_name);
        }

        return $result;
    }
}
