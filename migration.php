<?php

use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\DBAL\DriverManager;

$config = new PhpFile('migrations.php');

$connectionParams = [
    'url' => 'mysql://root:Angelica@1714@localhost:3306/carrier',
];

$connection = DriverManager::getConnection($connectionParams);
$config->setConnection($connection);

return $config;