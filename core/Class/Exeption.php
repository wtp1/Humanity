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
 use Exception;

/**
 * Обработка ошибок ядра
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class CoreException extends Exception
{

    /**
     * Вывод ошибок
     *
     * @return void
     */
    public function printError()
    {
        if ((int)Registry::get('Config.debug')>=1) {
            echo 'core error('.$this->getCode().'): '.$this->getMessage();
        }
        System::log('core error('.$this->getCode().'): '.$this->getMessage());
        if ((int)Registry::get('Config.debug')>=2) {
            echo '<pre>'.$this->getTraceAsString().'</pre>';
        }
        System::log($this->getTraceAsString());
        if (file_exists('../error/404.ctp')) {
            include_once '../error/404.ctp';
        }
        throw new Exception($this->getMessage(), $this->getCode());
        //die();
    }
}
