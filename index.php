<?php

session_start();

define('ROOT', realpath(__DIR__ ));

require_once(ROOT . '/src/Core/Kernel.php');
spl_autoload_register('\Example\Core\Kernel::classLoader');

$container = new \Example\Core\Container();
require ROOT . '/config/services.php';

$kernel = new \Example\Core\Kernel($container);
$kernel->run();