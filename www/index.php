<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require __DIR__ . '/.maintenance.php';
$container = require __DIR__ . '/../app/bootstrap.php';
define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', BASE_PATH . '/www');
define('SAVING_PATH', PUBLIC_PATH . '/uploads/images');
define('IMAGES_PATH', '/uploads/images');
$container->getByType(Nette\Application\Application::class)->run();
