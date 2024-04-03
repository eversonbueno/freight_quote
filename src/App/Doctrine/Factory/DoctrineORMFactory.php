<?php

namespace App\Doctrine\Factory;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineORMFactory
{
    public static function createEntityManager(array $dbParams, array $configPaths): EntityManagerInterface
    {
        $isDevMode = true; // Puedes ajustar esto según tu entorno

        // Configuración de Doctrine ORM
        $config = Setup::createXMLMetadataConfiguration($configPaths, $isDevMode);

        // Crea y retorna una instancia de EntityManager
        return EntityManager::create($dbParams, $config);
    }
}

// Uso de la fábrica para crear un EntityManager
$dbParams = [
    'driver' => 'pdo_mysql',
    'host'     => 'localhost',
    'port'     => 3306,
    'user'     => 'root',
    'password' => 'Angelica@1714',
    'dbname'   => 'api_freight_quote',
];

$configPaths = [__DIR__ . '/config/xml']; // Directorio que contiene los archivos de configuración XML de Doctrine

$entityManager = DoctrineORMFactory::createEntityManager($dbParams, $configPaths);