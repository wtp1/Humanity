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
 * Регистрация и получение
 * глобальных переменных
 * Шаблон Registry
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class Registry
{
    protected static $storage = array();

    /**
     * Защита от создания через конструктор
     */
    protected function __construct()
    {
    }

    /**
     * Защита от создания через клонирования
     *
     * @return void
     */
    protected function __clone()
    {
    }

    /**
     * Возвращает существующий
     *
     * @param string $name название ключа
     *
     * @return mixed значение
     */
    public static function exists($name)
    {
        return isset(self::$storage[$name]);
    }

    /**
     * Получить значение
     *
     * @param string $name название ключа
     *
     * @return значение или null
     */
    public static function get($name)
    {
        if (isset(self::$storage[$name])) {
            return self::$storage[$name];
        } else {
            null;
        }
    }

    /**
     * Установить значение
     *
     * @param string $name название ключа
     * @param mixed  $obj  значение
     *
     * @return mixed значение
     */
    public static function set($name, $obj)
    {
        return self::$storage[$name]=$obj;
    }
}
?>
