<?php
        namespace Module\Whoops;
        $moduleDir = $_SERVER['DOCUMENT_ROOT'] . '/app/modules/whoops/vendor';
        set_include_path(get_include_path() . PATH_SEPARATOR . $moduleDir);

        function autoload($className){
                $className = ltrim($className, '\\');
                $fileName  = '';
                $namespace = '';
                if ($lastNsPos = strrpos($className, '\\')) {
                        $namespace = substr($className, 0, $lastNsPos);
                        $className = substr($className, $lastNsPos + 1);
                        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
                }
                $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

                require $fileName;
        }

        spl_autoload_register('\Module\Whoops\autoload');

        $whoops = new \Whoops\Run();
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();

