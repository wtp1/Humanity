<?php
use bayon\core\Model;

class CellModel extends Model{

	/*
	* Создание ячейки
	*/
	function createCell($s_squares_id, $row_number, $column_number, $d_dirt_types_id, $d_relief_types_id, $d_vegetation_types_id, $d_water_resources_types_id)
	{
		// if ($this->checkCellDuplicate($x_coord, $y_coord) == 'not_found') {
			$query_str = "
				INSERT INTO s_cells
				(s_squares_id, row_number, column_number, d_dirt_types_id, d_relief_types_id, d_vegetation_types_id, d_water_resources_types_id)
				VALUES ($s_squares_id, $row_number, $column_number, $d_dirt_types_id, $d_relief_types_id, $d_vegetation_types_id, $d_water_resources_types_id)";

			echo $query_str."<br>";
			$query_result = $this->query($query_str, false);
			if (empty($query_result)) {
				return $query_result;
			} else {
				return "createCell_InternalError";
			}
		// } else {
		// 	return "createCell_checkCellDuplicate_Error";
		// }
	}

	/*
	 * Проверка существования ячейки с такими же координатами
	 */
	function checkCellDuplicate($x_coord, $y_coord)
	{
		$query_str = "SELECT id FROM s_cells WHERE x_coord = $x_coord AND y_coord = $y_coord";
		$query_result = $this->query($query_str, false);
		if (!empty($query_result)) {
			return 'found';
		} else {
			return 'not_found';
		}
	}

    /*
     * Получение информации о ячейке
     */
    function getCellInfo($cell_id)
    {
        if (!empty($cell_id)) {
            $query_str = "SELECT * FROM s_cells WHERE id = ".$cell_id;
            $query_result = $this->query($query_str, false);
            if ($query_result) {
                $result = array('type' => 'ok', 'value' => $query_result);
            } else {
                $result = array('type' => 'error', 'model' => get_class($this), 'value' => 'QueryError');
            }
        } else {
            $result = array('type' => 'error', 'model' => get_class($this), 'value' => 'EmptyCellId');
        }

        return $result;
    }
}
