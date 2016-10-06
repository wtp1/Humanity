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

namespace bayon\core\Driver;

/**
 * Фабрика для создания подключений
 * Шаблон фабрика
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
abstract class DriverFactory
{

    /**
     * Создание необходимого драйвера
     *
     * @param string $name - наименование драйвера
     *
     * @return array(connect,type,driver) - драйвер
     */
    public static function getFactory($name)
    {
        return new $name();
    }

    /**
     * Подключение
     *
     * @param string $config настройки драйвера
     *
     * @return void
     */
    public abstract function connect($config=null);

    /**
     * Запрос
     *
     * @param string $driver экземпляр драйвера
     * @param object $sql    SQL запрос
     * @param string $cache  true=использовать кеш
     *
     * @return void
     */
    public abstract function query($driver=null,$sql=null, $cache=false);

    /**
     * Подготовленный запрос
     *
     * @param object $driver экземпляр драйвера
     * @param string $sql    SQL запрос
     *
     * @return void
     */
    public abstract function prepare($driver=null,$sql=null);

    /**
     * Выполнение подготовленного запроса
     *
     * @param object    $driver экземпляр драйвера
     * @param statement $sth    коллекция
     *
     * @return void
     */
    public abstract function execute($driver=null,$sth=null);

    /**
     * Конвертировать результат запроса в массив
     *
     * @param statement $result коллекция
     *
     * @return void
     */
    public abstract function toArray($result=null);
}
