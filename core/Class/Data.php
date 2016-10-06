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
use Driver\DriverFactory;

/**
 * Класс для работы с базой данных
 * Шаблон Singleton
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class Data
{
    private static $_instance=null;

    /**
     * Защита от создания через new Data
     */
    private function __construct()
    {
    }

    /**
    * Защита от создания через клонирование
    *
    * @return void
    */
    private function __clone()
    {
    }

    /**
     * Подключение к БД
     *
     * @return void
     */
    public static function connect()
    {
        if (!isset(self::$_instance['connect'])) {
            include_once 'Driver/DriverFactory.php';
            $config=Registry::get('Config.db');
            include_once 'Driver/Driver'.$config['driver'].'.php';
            $driver=Driver\DriverFactory::getFactory('Driver'.$config['driver']);
            self::$_instance = array_merge(
                $driver->connect($config), array('driver'=>$driver)
            );
        }
        return self::$_instance;
    }

    /**
     * Отключение от БД
     *
     * @return void
     */
    public static function disconnect()
    {
        if (isset(self::$_instance)) {
            self::$_instance['connect']->close();
        }
    }

    /**
     * Вызов деструктора
     */
    final public function __destruct()
    {
        self::$_instance['connect']=null;
    }

    /**
     * Запрос к базе данных
     *
     * @param string  $sql   SQL запрос
     * @param boolean $cache false -не кешировать
     *                       true - кешировать
     *
     * @return array - результат в виде массива
     */
    public function query($sql, $cache=false)
    {
        if (!isset(self::$_instance['connect'])) {
            self::connect();
        }
        $res=self::$_instance['driver']->query(self::$_instance, $sql);
        return self::$_instance['driver']->toArray($res);
    }

    /**
     * Подготовленный запрос к базе данных
     *
     * @param string $sql SQL запрос
     *
     * @return void
     */
    public function prepare($sql)
    {
        if (!isset(self::$_instance['connect'])) {
            self::connect();
        }
        return self::$_instance['driver']->prepare(self::$_instance, $sql);
    }

    /**
     * Выполнить подготовленный запрос
     * и вернуть результат
     *
     * @param array $sth результат в виде массива
     *
     * @return void
     */
    public function execute($sth)
    {
        if (!isset(self::$_instance['connect'])) {
            self::connect();
        }
        return self::$_instance['driver']->execute(self::$_instance, $sth);
    }
}
