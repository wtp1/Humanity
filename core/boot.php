<?php
namespace bayon\core;

/**
 * Загрузчик
 *
 * PHP 5
 *
 * @author		//GM
 * @copyright	Глущенко М. С.,2015
 * @package		boot
 * @since		v1.0
 */
require_once 'Class/System.php';
require_once 'Class/Exeption.php';
require_once 'Class/Registry.php';
$app=array_reverse(explode('/',$_SERVER['PHP_SELF']));
require_once '../../'.$app[2].'/Config.php';
require_once 'lib/debug.php';

if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
if(!empty($app[3])) $app[3]=$app[3].'/';
if (!defined('SITE_DIR')) define('SITE_DIR', '/'.$app[3]);

require_once 'Class/Paranoid.php';
require_once 'Class/Object.php';
require_once 'Class/Data.php';
require_once 'Class/Controller.php';
require_once 'Class/Model.php';
require_once 'Class/View.php';
require_once 'Class/Route.php';
//require_once 'Class/Locale.php';
Route::start();
