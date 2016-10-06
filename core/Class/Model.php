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
 * Базовая модель
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class Model extends Object
{

    /**
     * Подключение дополнительных
     * моделей в конструкторе
     */
    function __construct()
    {
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
    }

    /**
     * Выполнить sql запрос
     *
     * @param unknown $sql   SQL запрос
     * @param string  $cache true кешировать
     * false не кешировать
     * @param boolean $html  true экранировать
     * для html иначе для sql
     *
     * @return array результат запроса
     */
    function query($sql,$cache=false,$html=true)
    {
        $app=array_reverse(explode('/', $_SERVER['PHP_SELF']));
        if ($cache) {
            $hash=md5($sql);
            if (!file_exists($app[2].'/tmp/cache/sql_'.$hash)) {
                if ($html) {
                    $res=Paranoid::clearForHTML(Data::query($sql));
                } else {
                    $res=Paranoid::clearForHTML(Data::query($sql));
                }
                file_put_contents(
                    $app[2].'/tmp/cache/sql_'.$hash, json_encode($res)
                );
            } else {
                $res=json_decode(
                    file_get_contents($app[2].'/tmp/cache/sql_'.$hash), true
                );
            }
        } else {
            if ($html) {
                $res=Paranoid::clearForHTML(Data::query($sql));
            } else {
                $res=Paranoid::clearForSQL(Data::query($sql));
            }
        }
        return $res;
    }

    /**
     * Подготовить sql запрос
     *
     * @param string $sql SQL запрос
     *
     * @return void
     */
    function prepare($sql)
    {
        return Data::prepare($sql);
    }

    /**
     * Выполнить запрос
     *
     * @param PDOStatement $sth подготовленный запрос
     *
     * @return array результат в виде массива
     */
    function execute($sth=null)
    {
        return Data::execute($sth);
    }
}
