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
 * Защита данных
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class Paranoid
{

    /**
     * Экранирование опасных символов
     *
     * @param string $str входящая строка
     *
     * @return [type]      [description]
    */
    public function prepareStr( $str )
    {
        return str_replace(
            array('\\',"\0","\n","\r","'",'"',"\x1a"),
            array('\\\\','\\0','\\n','\\r',"\\'",'\\"','\\Z'),
            $str
        );
    }

    /**
     * Очистить данные массива перед выводом в html
     *
     * @param array $data грязный массив
     *
     * @return array чистый массив
     */
    public function clearForHTML($data)
    {
        if (is_array($data)) {
            foreach ($data as $key=>$item) {
                if (is_array($item)) {
                    $data[$key]=Paranoid::clearForHTML($item);
                } else {
                    if (in_array($key, array('data','pic','permissions'))) {
                        $data[$key]=$item;
                    } else {
                        $data[$key]=htmlspecialchars($item);
                    }
                }
            }
            return $data;
        } else {
            return htmlspecialchars($data);
        }
    }

    /**
     * Очистить данные перед выполнением
     * SQL запроса. Если поле в POST начинается
     * с прифекса "json_" то не экранируется
     *
     * @param array $data грязный массив
     *
     * @return array чистый массив
     */
    public function clearForSQL($data)
    {
        if (is_array($data)) {
            foreach ($data as $key=>$item) {
                if (is_array($item)) {
                    $data[$key]=Paranoid::clearForSQL($item);
                } else {
                    $data[$key]=Paranoid::prepareStr($item);
                }
            }
            return $data;
        } else {
            return Paranoid::prepareStr($data);
        }
    }
}
?>
