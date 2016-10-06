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

use bayon\core\Driver\DriverFactory;
use bayon\core\coreException;

/**
 * Драйвер MySQLi для подключения к базе данных
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class DriverMySQLi extends DriverFactory
{

    /**
     * Подключение к БД
     *
     * @param mixed $config конфиг подключения
     *
     * @return object подключение
     */
    function connect($config=null)
    {
        $con=null;
        try {
            $mysqli=new mysqli(
                $config['host'],
                $config['user'],
                $config['password'],
                $config['database']
            );
            if ($mysqli->connect_errno) {
                throw new coreException(
                    'SQL['.$mysqli->connect_errno.'] Access denied to database'
                );
            } else {
                $mysqli->set_charset("utf8");
                $con=array('connect'=>$mysqli,'type'=>'MySQLi');
            }
        } catch (corelException $e) {
            $e->printError();
        }
        return $con;
    }

    /**
     * Выполнение запроса
     *
     * @param array   $driver драйвер
     * @param string  $sql    запрос
     * @param boolean $cash   использовать кэш
     *
     * @return array результат в массиве
     */
    function query($driver=null,$sql=null,$cash=false)
    {
        try {
            $res=$driver['connect']->query($sql);
            if (!$res) {
                throw new coreException(
                    'SQL['.$driver['connect']->errno.'] '.$driver['connect']->error
                );
            }
        }catch(coreException $e) {
            $e->printError();
        }
        return $res;
    }

    /**
     * Конвертировать результат в массив
     *
     * @param mixed $result выборка данных
     *
     * @return array массив
     */
    function toArray($result=null)
    {
        $results=array();
        if (is_object($result)) {
            $fields=$result->fetch_fields();
            $count_fields=sizeof($fields);
            while (($row=$result->fetch_array())!=false) {
                $tmp=array();
                $i=0;
                while (isset($fields[$i])) {
                    if (!empty($fields[$i]->table)) {
                        $tmp[$fields[$i]->table][$fields[$i]->name]=$row[$i];
                    } else {
                        $tmp[0][$fields[$i]->name]=$row[$i];
                    }
                    $i++;
                }
                $results[]=$tmp;
            }
        }
        return $results;
    }

    /**
     * Подготовленные выражения
     *
     * @param array  $driver драйвер
     * @param string $sql    запрос
     *
     * @return array результат выборки
     */
    public function prepare($driver=null,$sql=null)
    {
        //TODO в разработке
    }

    /**
     * Выполнить команду
     *
     * @param array  $driver драйвер
     * @param string $sth    коллекция
     *
     * @return array результат выборки
     */
    public function execute($driver=null,$sth=null)
    {
        //TODO в разработке
    }
}
