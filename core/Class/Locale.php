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
 * Интернационализация
 *
 * @category  Bayon
 * @package   Core
 * @author    Глущенко Михаил <zshgm@mail.ru>
 * @copyright 2016 GM
 * @license   https://opensource.org/licenses/MIT MIT Licence
 * @version   Release: 1.0.1
 * @link      https://github.com/zshgm/bayon.git
 */
class Locale
{

    /**
     * Установка локали
     *
     * @return void
     */
    static function setup()
    {
        if (!empty($_SESSION['locale'])) {
            if (!empty($_SESSION['locale']['name'])) {
                setlocale(LC_ALL, $_SESSION['locale']['name']);
            }
            if (!empty($_SESSION['locale']['domain'])) {
                bindtextdomain($_SESSION['locale']['domain'], "../locale");
                textdomain($_SESSION['locale']['domain']);
            }
        }
    }
}
Locale::setup();
