<?php
/**
 * Режимы отладки
 * 0-отладка выключена
 * 1-пользовательские сообщения
 * 2-пользовательские и системные сообщения
 * 3-пользовательские, системные сообщения с выводом trace
 */
use bayon\core\Registry;

Registry::set('Config.debug', 3);

/**
 * Отображать скорость выполнения скрипта
 */
Registry::set('Config.time', false);

/**
 * Настройки маршрутизации
 * default-контроллер и действие по умолчанию
 */
Registry::set('Config.routes',array('/'=>array('controller'=>'main','action'=>'index')));

/**
 * Настройки подключения к базе данных
 * если не требуется подключение к бд - пустой массив
 * Registry::set('Config.db',array());
 */
Registry::set('Config.db',
	array(
		'driver'=>'MySQLi',
		'host'=>'localhost',
		'user'=>'root',
		'password'=>'root',
		'database'=>'humanity_main',
		'encoding'=>'utf8',
	)
);

/**
 * Случайная комбинация символов, для увеличения надежности хеширования
 */
Registry::set('Config.salt', 'DYhG7900qyJfIxfs2guVoUubWwvni12G0FgaC9mA');
