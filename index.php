<?php

session_start();

define('ROOT', realpath(__DIR__ ));

require_once(ROOT . '/src/Core/Kernel.php');
spl_autoload_register('\Example\Core\Kernel::classLoader');

$kernel = new \Example\Core\Kernel(new \Example\Core\Container());
$kernel->run();