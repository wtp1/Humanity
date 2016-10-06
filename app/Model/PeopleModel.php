<?php
use bayon\core\Model;

class PeopleModel extends Model{

	function example(){
		return "asd!";
	}

	/*
	* Создание человека
	*/
	function createHuman($race, $territory_cell_id, $father_id = null, $mother_id = null)
	{
		$gender = rand(1);
		if (is_null($father_id) and is_null($mother_id)) {

		}

		return "asd!";
	}

	/*
	* Создание семъи
	*/
	function createFamily($race, $territory_cell_id, $social_group_id)
	{
		return "asd!";
	}

}
