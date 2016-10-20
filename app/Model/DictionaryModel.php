<?php
use bayon\core\Model;

class DictionaryModel extends Model{

    /*
    * Получение всех квадратов для отрисовки карты
    */
    function getDictionaryValues($dict_name)
    {
        switch ($dict_name) {
            case 'dirt_types':
                $table_name = 'd_dirt_types';
                break;
            case 'relief_types':
                $table_name = 'd_relief_types';
                break;
            case 'vegetation_types':
                $table_name = 'd_vegetation_types';
                break;
            case 'water_resources_types':
                $table_name = 'd_water_resources_types';
                break;
            case 'resource_groups':
                $table_name = 'd_resource_groups';
                break;
            case 'resources':
                $table_name = 'd_resources';
                break;

            default:
                $table_name = '';
                $result = array('type' => 'error', 'model' => get_class($this), 'value' => 'QueryError');
                break;
        }
        if ($table_name<>'') {
            $query_str = "SELECT * FROM $table_name";
            $query_result = $this->query($query_str, false);
            if ($query_result) {
                $result = array('type' => 'ok', 'value' => $query_result);
            } else {
                $result = array('type' => 'error', 'model' => get_class($this), 'value' => 'QueryError');
            }
        }

        return $result;
    }

}
