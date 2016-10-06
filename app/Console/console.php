<?php
namespace bayon\core;

$start_time = microtime(true);
$mem_start=memory_get_usage();
if(!defined('SITE_DIR')) {
	define('SITE_DIR', dirname($_SERVER['PHP_SELF']).'/');
}

require_once '../../core/Class/System.php';
require_once '../../core/Class/Logging.php';
require_once '../../core/Class/Exeption.php';
require_once '../../core/Class/Registry.php';
require_once '../../app/Config.php';
require_once '../../core/lib/debug.php';
require_once '../../core/Class/Paranoid.php';
require_once '../../core/Class/Object.php';
require_once '../../core/Class/Data.php';
require_once '../../core/Class/Controller.php';
require_once '../../core/Class/Model.php';
require_once '../../core/Class/View.php';
$class=$argv[1].'Shell';
require_once '../../app/Console/'.$class.'.php';

echo "\r\n\r\n".$argv[1]."Shell:\r\n";
$shell = new $class;
unset($argv[0]);
unset($argv[1]);
$shell->main(array_values($argv));

$mem_end=memory_get_usage();
$exec_time = microtime(true) - $start_time;

echo "\r\nDEBUG:: time:".round($exec_time,5).'s; mem:'.round(($mem_end-$mem_start)/1024,2)." kb\r\n";
