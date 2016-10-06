<?php
use bayon\core\Model;

class MapModel extends Model{

  /*
	* Получение всех квадратов для отрисовки карты
	*/
	function getSquares()
	{
		$query_str =
		"SELECT * FROM s_squares
        ORDER BY x_coord, y_coord";
		$query_result = $this->query($query_str, false);
		return $query_result;
	}

	/*
	* Получение ячеек квадрата для отрисовки карты
	*/
	function getCells($s_squares_id)
	{
		$query_str =
		"SELECT * FROM s_cells
		LEFT JOIN d_dirt_types ON s_cells.d_dirt_types_id = d_dirt_types.id
		LEFT JOIN d_relief_types ON s_cells.d_relief_types_id = d_relief_types.id
		LEFT JOIN d_vegetation_types ON s_cells.d_vegetation_types_id = d_vegetation_types.id
		LEFT JOIN d_water_resources_types ON s_cells.d_water_resources_types_id = d_water_resources_types.id
        WHERE s_cells.s_squares_id = $s_squares_id
        ORDER BY s_cells.column_number, s_cells.row_number";
		$query_result = $this->query($query_str, false);
		return $query_result;
	}

  /**
   * Изменение параметров клетки
   */
  function changeCellParam($cell_id, $param_name, $param_value)
  {
    $query_str =
    "UPDATE s_cells
    SET ".$param_name."_id = ".$param_value."
    WHERE id = ".$cell_id;
    $this->query($query_str, false);
  }

  /**
   * Получение параметров клетки
   */
  function getCellParam($cell_id)
  {
    $query_str =
    "SELECT * FROM s_cells
    LEFT JOIN d_dirt_types ON s_cells.d_dirt_types_id = d_dirt_types.id
    LEFT JOIN d_relief_types ON s_cells.d_relief_types_id = d_relief_types.id
    LEFT JOIN d_vegetation_types ON s_cells.d_vegetation_types_id = d_vegetation_types.id
    LEFT JOIN d_water_resources_types ON s_cells.d_water_resources_types_id = d_water_resources_types.id
    WHERE s_cells.id = ".$cell_id;
    return $this->query($query_str, false);
  }

    /*
     * Получение максимальных значений координат квадратов карты
     */
    function getMaxSquaresCoords()
    {
      $query_str = "SELECT max(x_coord) as x_coord, max(y_coord) as y_coord FROM s_squares";
      $query_result = $this->query($query_str, false);
      return $query_result;
    }
}
