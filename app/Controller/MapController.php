<?php
use bayon\core\Controller;

class MapController extends Controller{
	var $uses=array('Map', 'Dictionary', 'Cell');

	function before($action=''){

	}

	/**
	 * Пример метода в контроллере
	 */
	function index(){
		$this->set('start','hello world!');
	}

	/**
	 * Отображение карты
	 */
	function showMap()
	{
        $squares_res = $this->Map->getSquares();
        // pr($squares_res);
        foreach ($squares_res as $square) {
            $x_coord = $square['s_squares']['x_coord'];
            $y_coord = $square['s_squares']['y_coord'];
            $squares['x_coord'][$x_coord]['y_coord'][$y_coord] = $square['s_squares'];
        }
        // pr($squares);
        foreach ($squares_res as $square) {
            $cells = $this->Map->getCells($square['s_squares']['id']);
            $cell_list['square_id'][$square['s_squares']['id']] = $square;
            $cell_list['square_id'][$square['s_squares']['id']]['cells'] = $cells;
        }

		$this->set('squares',$squares);
		$this->set('cell_list',$cell_list);
	}

    /**
	 * Отображение карты
	 */
	function showMapEditor()
	{
        $squares_res = $this->Map->getSquares();
        foreach ($squares_res as $square) {
            $x_coord = $square['s_squares']['x_coord'];
            $y_coord = $square['s_squares']['y_coord'];
            $squares['x_coord'][$x_coord]['y_coord'][$y_coord] = $square['s_squares'];
        }
        foreach ($squares_res as $square) {
            $cells = $this->Map->getCells($square['s_squares']['id']);
            $cell_list['square_id'][$square['s_squares']['id']] = $square;

            $cells_sorted = array();
            foreach ($cells as $cell) {
								$cellResources = $this->Map->getCellResources($cell['s_cells']['id']);
								foreach ($cellResources as $cellResource) {
										$cell['s_cell_resources'][$cellResource['s_cell_resources']['d_resources_id']] = $cellResource['s_cell_resources'];
								}
                $cells_sorted[$cell['s_cells']['row_number']]['cells'][] = $cell;
            }
            $cell_list['square_id'][$square['s_squares']['id']]['rows'] = $cells_sorted;
        }

				$getMaxSquaresCoords_result = $this->Map->getMaxSquaresCoords();

				$d_resource_groups = $this->Dictionary->getDictionaryValues('resource_groups');
        if ($d_resource_groups['type']=='ok') {
						foreach ($d_resource_groups['value'] as $d_resource_group) {
								$d_resource_groups_tmp[$d_resource_group['d_resource_groups']['id']] = $d_resource_group['d_resource_groups'];
						}
            $resources['resource_group'] = $d_resource_groups_tmp;
        }
				$d_resources = $this->Dictionary->getDictionaryValues('resources');
        if ($d_resources['type']=='ok') {
						foreach ($d_resources['value'] as $d_resource) {
								$d_resources_tmp[$d_resource['d_resources']['id']] = $d_resource['d_resources'];
						}
            $resources['resource'] = $d_resources_tmp;
        }

				$this->set('squares', $squares);
				$this->set('cell_list', $cell_list);
				$this->set('map_square_x_coord_max', $getMaxSquaresCoords_result[0][0]['x_coord']);
				$this->set('map_square_y_coord_max', $getMaxSquaresCoords_result[0][0]['y_coord']);
				$this->set('resources', $resources);
		}

    /**
     * Окно инструментов в редакторе карт
     */
    function toolsDialog()
    {
        $this->layout='ajax';

        $d_dirt_types = $this->Dictionary->getDictionaryValues('dirt_types');
        if ($d_dirt_types['type']=='ok') {
            $dictionaries['dirt_type'] = $d_dirt_types['value'];
        }

        $d_relief_types = $this->Dictionary->getDictionaryValues('relief_types');
        if ($d_relief_types['type']=='ok') {
            $dictionaries['relief_type'] = $d_relief_types['value'];
        }

				$d_water_resources_types = $this->Dictionary->getDictionaryValues('water_resources_types');
        if ($d_water_resources_types['type']=='ok') {
            $dictionaries['water_resources_type'] = $d_water_resources_types['value'];
        }

        $d_vegetation_types = $this->Dictionary->getDictionaryValues('vegetation_types');
        if ($d_vegetation_types['type']=='ok') {
            $dictionaries['vegetation_type'] = $d_vegetation_types['value'];
        }

				$d_resource_groups = $this->Dictionary->getDictionaryValues('resource_groups');
        if ($d_resource_groups['type']=='ok') {
            $resources['resource_group'] = $d_resource_groups['value'];
        }

				$d_resources = $this->Dictionary->getDictionaryValues('resources');
        if ($d_resources['type']=='ok') {
						foreach ($d_resources['value'] as $d_resource) {
								$d_resources_tmp[$d_resource['d_resources']['d_resource_groups_id']][] = $d_resource['d_resources'];
						}
            $resources['resource'] = $d_resources_tmp;
        }

				$this->set('dictionaries', $dictionaries);
				$this->set('resources', $resources);
    }

    /**
     * Отрисовка диалога изменения клетки
     */
    function getCellEditorDialog($cell_id)
    {
        $this->layout='ajax';

        $dirt_types = $this->Dictionary->getDictionaryValues('dirt_types');
        $relief_types = $this->Dictionary->getDictionaryValues('relief_types');
        $vegetation_types = $this->Dictionary->getDictionaryValues('vegetation_types');
        $water_resources_types = $this->Dictionary->getDictionaryValues('water_resources_types');
        $cell_info = $this->Cell->getCellInfo($cell_id);

        $dictionaries['d_dirt_types'] = array(
            'name' => 'Почвенный покров', 'values' => $dirt_types['value']);
        $dictionaries['d_relief_types'] = array(
            'name' => 'Рельеф', 'values' => $relief_types['value']);
        $dictionaries['d_vegetation_types'] = array(
            'name' => 'Растительность', 'values' => $vegetation_types['value']);
        $dictionaries['d_water_resources_types'] = array(
            'name' => 'Водные ресурсы', 'values' => $water_resources_types['value']);
        $this->set('dictionaries', $dictionaries);

        $this->set('cell_info', $cell_info['value']);
    }

    /**
     * Сохранение параметров клетки
     */
    function saveCellParams()
    {
        $this->layout='ajax';
        $cell_id = $this->data['cell_id'];
        unset($this->data['cell_id']);
        if (isset($this->data['field_list']['brush'])) {
            $brush = $this->data['field_list']['brush'];
            unset($this->data['field_list']['brush']);
        }
				if (isset($this->data['field_list']['d_resources'])) {
						$this->Map->changeCellResource($cell_id, $this->data['field_list']['d_resources']);
				} else {
						unset($this->data['field_list']['d_resources']);
						foreach ($this->data['field_list'] as $param_name => $param_value) {
								$this->Map->changeCellParam($cell_id, $param_name, $param_value);
						}
				}
    }

    /**
     * Обновление клетки на карте после изменения ее параметров
     */
    function refreshCell()
    {
        $this->layout='ajax';
        $cell = $this->Map->getCellParam($this->data['cell_id']);
        $this->set('cell_id', $this->data['cell_id']);
        $this->set('cell', $cell[0]);
    }
}
