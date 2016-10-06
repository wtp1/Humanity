<?php
use bayon\core\Model;

class SettlementModel extends Model{

	/*
	* Создание поселения
	*/
	function createSettlement($cell_id, $settlement_name)
	{
		if ($this->checkSettlementDuplicate($cell_id) == 'not_found') {
			$query_str = "
				INSERT INTO s_settlements
				(name, s_cells_id)
				VALUES ('$settlement_name', $cell_id)";

			echo $query_str."<br>";
			$query_result = $this->query($query_str, false);
			if (empty($query_result)) {
				return $query_result;
			} else {
				return "createSettlement_InternalError";
			}
		} else {
			return "createSettlement_checkSettlementDuplicate_Error";
		}
	}

	/*
	 * Проверка существования поселения с такими же координатами
	 */
	function checkSettlementDuplicate($cell_id)
	{
		$query_str = "SELECT id FROM s_settlements WHERE s_cells_id = $cell_id";
		$query_result = $this->query($query_str, false);
		if (!empty($query_result)) {
			return 'found';
		} else {
			return 'not_found';
		}
	}

}
