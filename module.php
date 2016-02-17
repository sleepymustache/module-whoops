<?php
	namespace Module\Whoops;

	$moduleDir = $_SERVER['DOCUMENT_ROOT'] . '/app/modules/whoops';
	set_include_path(get_include_path() . PATH_SEPARATOR . $moduleDir);
	spl_autoload_register();

	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();