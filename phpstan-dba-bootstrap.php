<?php

use staabm\PHPStanDba\DbSchema\SchemaHasherMysql;
use staabm\PHPStanDba\QueryReflection\MysqliQueryReflector;
use staabm\PHPStanDba\QueryReflection\QueryReflection;
use staabm\PHPStanDba\QueryReflection\ReflectionCache;
use staabm\PHPStanDba\QueryReflection\ReplayAndRecordingQueryReflector;
use staabm\PHPStanDba\QueryReflection\ReplayQueryReflector;
use staabm\PHPStanDba\QueryReflection\RuntimeConfiguration;

require_once __DIR__ . '/vendor/autoload.php';

const CACHE_FILE = __DIR__ . '/.phpstan-dba.cache';

$runtimeConfig = new RuntimeConfiguration();
$reflectionCache = ReflectionCache::create(CACHE_FILE);

try {
    $mysqli = new mysqli('mariadb', 'root', 'root', 'db');
    $useDatabase = true;
    $runtimeConfig->debugMode(true);
    $runtimeConfig->analyzeQueryPlans(false);
} catch (mysqli_sql_exception) {
    $useDatabase = false;
}

QueryReflection::setupReflector(
    $useDatabase ? new ReplayAndRecordingQueryReflector(
        $reflectionCache,
        new MysqliQueryReflector($mysqli),
        new SchemaHasherMysql($mysqli),
    ) : new ReplayQueryReflector($reflectionCache),
    $runtimeConfig
);
