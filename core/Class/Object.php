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
 * Базовый объект
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class Object
{
    /**
     * Подключение класса
     * и создание его экземпляра
     *
     * @param string $type   Controller или Model
     * @param string $name   название
     * @param string $plugin название плагина
     *
     * @return object
     */
    static function getObject($type,$name,$plugin=null)
    {
        if (!empty($plugin)) {
            $path='../Plugin/'.$plugin.'/'.$type.'/'.$name.$type.'.php';
        } else {
            $path='../'.$type.'/'.$name.$type.'.php';
        }
        try {
            if (file_exists($path)) {
                include_once $path;
            } else {
                throw new coreException('no such file "'.$path.'"');
            }
        } catch(coreException $e) {
            $e->printError();
        }
        $class=$name.$type;
        $obj = new $class;
        return $obj;
    }
}
