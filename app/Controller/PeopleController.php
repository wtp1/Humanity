<?php
use bayon\core\Controller;

class PeopleController extends Controller{
	var $uses=array('Main');

	function before($action=''){

	}

	/**
	 * Пример метода в контроллере
	 */
	function index(){
		$this->set('start','hello world!');
	}

	/**
	 * Отображение всех людей
	 */
	function listPeople(){
		$this->set('start','<br>hello world!2');
	}

}
