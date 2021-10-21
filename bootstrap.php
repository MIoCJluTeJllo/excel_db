<?php
// bootstrap.php
include 'exelconfig.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/db/entities"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

$conn = array(
    'driver' => 'pdo_mysql',
    'dbname' => $DB_NAME,
    'user' => $DB_USER,
    'password' => $DB_PSW,
    'host' => $DB_HOST,
);

$entityManager = EntityManager::create($conn, $config);