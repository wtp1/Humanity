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
 * Драйвер PDO для подключения к базе данных
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class DriverPDO extends DriverFactory
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
            $dbh = new PDO(
                "mysql:host=".$config['host'].
                ";dbname=".$config['database'].
                ";charset=".$config['encoding'],
                $config['user'],
                $config['password']
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con=array('connect'=>$dbh,'type'=>'PDO');
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
        } catch (coreException $e) {
            $e->printError();
        }
        return $res;
    }

    /**
     * Подготовленные выражения
     *
     * @param array  $driver драйвер
     * @param string $sql    запрос
     *
     * @return array результат выборки
     */
    function prepare($driver=null, $sql=null)
    {
        $sth=$driver['connect']->prepare($sql);
        return $sth;
    }

    /**
     * Выполнить команду
     *
     * @param array  $driver драйвер
     * @param string $sth    коллекция
     *
     * @return array результат выборки
     */
    function execute($driver=null, $sth=null)
    {
        $sth->execute();
        return $this->toArray($sth);
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
            $count_fields=$result->columnCount();
            for ($i=0;$i<$count_fields;$i++) {
                $fields[]=$result->getColumnMeta($i);
            }
            while (($row=$result->fetch())!=false) {
                $tmp=array();
                $i=0;
                while (isset($fields[$i])) {
                    if (!empty($fields[$i]['table'])) {
                        $tmp[$fields[$i]['table']][$fields[$i]['name']]=$row[$i];
                    } else {
                        $tmp[0][$fields[$i]['name']]=$row[$i];
                    }
                    $i++;
                }
                $results[]=$tmp;
            }
        }
        return $results;
    }
}
