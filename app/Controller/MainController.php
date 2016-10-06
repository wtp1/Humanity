<?php
use bayon\core\Controller;

class MainController extends Controller{
	var $uses=array('Main', 'People', 'Cell', 'Settlement', 'Map');

	function before($action=''){

	}

	/**
	 * Пример метода в контроллере
	 */
	function index()
	{
		// $this->set('start','hello world!');

		// $this->People->listPeople();
		// echo $this->People->example();
		$this->generateWorld();
	}

	/**
	 * Пример метода в контроллере
	 */
	function generateWorld()
	{
		// $race = 1;
		// $territory_cell_id = 4;
		// $father_id = null;
		// $mother_id = null;
		// for ($i = 0; $i < 10; $i++) {
		// 	$this->People->createHuman($race, $territory_cell_id, $father_id, $mother_id);
		// }

		// $s_squares_id, $row_number, $column_number, $d_relief_types_id, $d_vegetation_types_id, $d_water_resources_types_id
        exit;
        for ($s_squares_id = 1; $s_squares_id <= 4; $s_squares_id++) {
            $row_number = 1;
            $column_number = 0;
            for ($i=1; $i <= 100; $i++) {
                $column_number++;

                $d_dirt_types_id = 4;
                if ($s_squares_id>=$i)
                    $d_dirt_types_id = 1;
                $res = $this->Cell->createCell($s_squares_id, $row_number, $column_number, $d_dirt_types_id, 2, 4, 3);

                if ($column_number>=10) {
                    $row_number++;
                    $column_number = 0;
                }
            }
        }

		// $cell_id, $settlement_name
		// $this->Settlement->createSettlement(1, 'Ивановка');
	}

}
