<?php
/**
 * Ядро Bayon
 *
 * PHP version 5
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/zshgm/bayon.git
 */

namespace bayon\core;

/**
 * Маршрутизация
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class Route extends Object
{

    /**
     * Запуск процесса маршрутизации
     *
     * @return void
     */
    static function start()
    {
        try{
            if (SITE_DIR=='/') {
                $route=trim($_SERVER['REQUEST_URI'], DS);
            } else {
                $route=trim(str_replace(SITE_DIR, '', $_SERVER['REQUEST_URI']), DS);
            }
               $route=explode('/', $route);
               $plugin_name=null;
               $action_name='index';
               $params=array();
               //маршрушт по умолчанию
            if (empty($route[0])) {
                $routes=Registry::get('Config.routes');
                if (!empty($routes['/']['plugin'])) {
                    $plugin_name=ucfirst($routes['/']['plugin']);
                }
                $controller_name=ucfirst($routes['/']['controller']);
                if (!empty($routes['/']['action'])) {
                    $action_name=$routes['/']['action'];
                }
                unset($routes);
            } else {
                if ($route[0]=='plugin') {
                    $find_file_plugin='../Plugin/'.$route[1].
                    '/webroot/'.$route[2].'/'.
                    $route[3];
                    if (file_exists($find_file_plugin)) {
                        $type=explode('.', $route[3]);
                        if (!empty($type[1])) {
                            if ($type[1]=='css') {
                                header("Content-type: text/css");
                            }
                        }
                        include_once $find_file_plugin;
                        exit;
                    }
                }
                if (!file_exists('../Plugin/'.ucfirst($route[0]))) {
                    array_unshift($route, null);
                }
                $plugin_name=ucfirst($route[0]);
                $controller_name=ucfirst($route[1]);
                if (!empty($route[2])) {
                    $action_name=$route[2];
                }
                unset($route[0],$route[1],$route[2]);
                $params=$route;
            }
              Registry::set('plugin', $plugin_name);
              Registry::set('controller', $controller_name);
              Registry::set('action', $action_name);

              $controller=Object::getObject(
                  'Controller',
                  $controller_name,
                  $plugin_name
              );
            if (method_exists($controller, $action_name)) {
                $controller->before($action_name);
                call_user_func_array(array(&$controller, $action_name), $params);
                $controller->start();
                $controller->after($action_name);
            } else {
                throw new coreException("method not found");
            }
                  unset($controller);
        } catch (coreException $e) {
            $e->printError();
        }
    }
}
