<?php
/**
 * Whoops Module
 *
 * The Whoops module adds a better event handler to the development environment to
 * help developers get better debug information.
 *
 * php version 7.0.0
 *
 * @category Module
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */

namespace Module\Whoops;

use \Sleepy\Core\Loader;
use \Sleepy\Core\Hook;
use \Sleepy\Core\Module;

/**
 * Whoops Module Class
 *
 * @category Module
 * @package  Sleepy
 * @author   Jaime A. Rodriguez <hi.i.am.jaime@gmail.com>
 * @license  http://opensource.org/licenses/MIT; MIT
 * @link     https://sleepymustache.com
 */
class ErrorHander extends Module
{
    public $hooks = [
        'errorhandler_preprocess' => 'setup',
        'sleepy_preprocess'       => 'install'
    ];

    /**
     * Setup the environments
     *
     * @return void
     */
    public function setup()
    {
        $this->environments['stage'] = false;
        $this->environments['live']  = false;
    }

    /**
     * Install the whoops error handler
     *
     * @return void
     */
    public function install()
    {
        Loader::addNamespace(
            "Whoops", $_SERVER['DOCUMENT_ROOT'] . '\app\module\whoops\vendor\Whoops'
        );

        $whoops = new \Whoops\Run();
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
}

Hook::register(new ErrorHander());
