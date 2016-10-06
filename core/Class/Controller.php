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
 * Базовый контроллер
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class Controller extends Object
{
    public $model;
    public $view_obj;
    public $view='';
    public $data=array();
    public $layout='default';
    public $title='';
    public $ext='';

    /**
     * Подключение конфигов из configs
     * Подключение моделей из uses
     * Регистрация переменных из $_POST
     */
    function __construct()
    {
        //Определить директорию app
        $app=array_reverse(explode('/', $_SERVER['PHP_SELF']));
        //Подключение конфигов
        if (!empty($this->configs)) {
            foreach ($this->configs as $config) {
                $item=explode('/', $config);
                if (!empty($item[1])) {
                    include_once $app[2].'/Plugin/'.$item[0].'/'.$item[1].'.php';
                } else {
                    include_once $app[2].'/'.$config.'.php';
                }
            }
        }
        //Подключение моделей
        if (!empty($this->uses)) {
            foreach ($this->uses as $obj) {
                $item=explode('/', $obj);
                if (!empty($item[1])) {
                    $obj=$item[0].$item[1];
                    $this->$obj=Object::getObject('Model', $item[1], $item[0]);
                } else {
                    $this->$obj=Object::getObject('Model', $obj, null);
                }
            }
        }
        //Подключение компонентов
        if (!empty($this->components)) {
            foreach ($this->components as $obj) {
                $item=explode('/', $obj);
                if (!empty($item[1])) {
                    $obj=$item[0].$item[1];
                    $this->$obj=Object::getObject('Component', $item[1], $item[0]);
                } else {
                    $this->$obj=Object::getObject('Component', $obj, null);
                }
            }
        }
        $this->view_obj = new View();
        $this->data=$_POST;
    }

    /**
     * Передать данные из контроллера
     * в отображение
     *
     * @param string  $key   ключ
     * @param unknown $value значение
     *
     * @return void
     */
    function set($key,$value)
    {
        $this->data[$key]=$value;
    }

    /**
     * Действие до
     *
     * @param string $action название действия
     *
     * @return void
     */
    function before($action)
    {

    }

    /**
     * Передача в отображение
     *
     * @return void
     */
    function start()
    {
        $this->view_obj->plugin=Registry::get('plugin');
        $this->view_obj->controller=Registry::get('controller');
        $this->view_obj->action=Registry::get('action');
        $this->view_obj->view=$this->view;
        $this->view_obj->ext=$this->ext;
        $this->view_obj->title=$this->title;
        $this->view_obj->render($this->layout, $this->data);
    }

    /**
     * Действие после
     *
     * @param string $action название действия
     *
     * @return void
     */
    function after($action)
    {

    }

    /**
     * Редирект на другой относительный адрес
     *
     * @param string $url адрес страницы
     *
     * @return void
     */
    function redirect($url)
    {
        if ($url=='/') {
            $url=SITE_DIR;
        } else {
            $url=SITE_DIR.$url;
        }
        header('Location: '.$url);
        die();
    }

    function pr($value)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }
}
