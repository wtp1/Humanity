<?php
/**
 * Отладчик
 *
 * PHP 5
 *
 * @author		//GM
 * @copyright	Глущенко М. С.,2015
 * @package		lib.debug
 * @since		v1.0
 */

/**
 * Удобный вывод на экран при отладке
 */
use bayon\core\Registry;

function pr($msg){
	if((int)Registry::get('Config.debug')>=2){
		echo '<pre>';
		echo print_r($msg);
		echo '</pre>';
	}
}
