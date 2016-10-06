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
 * Логирование
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class System
{

    /**
     * Добавить в лог
     *
     * @param string $msg       сообщение
     * @param string $file_name название лога
     *
     * @return void
     */
    public function log($msg='', $file_name='error')
    {
        $fp = fopen('../tmp/logs/'.$file_name.'.log', 'a');
        fwrite($fp, date('d.m.Y H:i:s', time()).': '.print_r($msg, true)."\r\n");
        fclose($fp);
    }
}
