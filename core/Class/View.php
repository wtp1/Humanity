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
 * Базовое отображение
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class View
{
    private $webroot;
    public $plugin;
    public $controller;
    public $action;
    public $view;
    public $data;
    public $title;
    public $ext;

    /**
     * Передача webroot
     */
    function __construct()
    {
        $this->webroot=SITE_DIR;
    }

    /**
     * Подключение шаблона отображения
     *
     * @param string $file название файла шаблона
     * @param array  $data массив переменных,
     * которые попадут в отображение
     *
     * @return void
     */
    function render($file, $data)
    {
        $this->data=$data;
        if (!empty($this->plugin)) {
            include '../Plugin/'.$this->plugin.'/View/Layouts/'.$file.'.ctp';
        } else {
            include '../View/Layouts/'.$file.'.ctp';
        }
        extract($this->data, EXTR_OVERWRITE);
    }

    /**
     * Подключение отображение элемента
     *
     * @param string $file   название файла элемента
     * @param string $plugin название плагина
     * @param array  $data   массив параметров
     *
     * @return void
     */
    function element($file, $plugin=null, $data=array())
    {
        extract($this->data, EXTR_OVERWRITE);
        extract($data, EXTR_OVERWRITE);
        //Ищу главный конфиг по умолчанию
        if (!empty($plugin)) {
            $config='../Plugin/'.$plugin.'/Config.php';
        } else {
            $config='../Config.php';
        }
        if (file_exists($config)) {
            include_once $config;
        }
        if (!empty($plugin)) {
            include '../Plugin/'.$plugin.'/View/Elements/'.$file.'.ctp';
        } else {
               include '../View/Elements/'.$file.'.ctp';
        }
    }

    /**
     * Подключение нужного отображения в шаблоне
     *
     * @return void
     */
    function fetch()
    {
        $ext='.ctp';
        if (!empty($this->ext)) {
            $ext='.'.$this->ext;
        }
        extract($this->data, EXTR_OVERWRITE);
        if (!empty($this->view)) {
            $this->action=$this->view;
        }
        if (!empty($this->plugin)) {
            $path='../Plugin/'.$this->plugin.
            '/View/'.$this->controller.'/'.
            $this->action.$ext;
        } else {
            $path='../View/'.$this->controller.'/'.$this->action.$ext;
        }
        if (file_exists($path)) {
            include $path;
        }
    }

    /**
     * ФЛК форм
     *
     * @param array $data входные данные
     *
     * @return void
     */
    function rules($data)
    {
        extract($data, EXTR_OVERWRITE);
        include '../../core/lib/rules.ctp';
    }
}
