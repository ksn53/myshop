<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR);

spl_autoload_register(function ($classname) {
    $className = ltrim($classname, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    require $fileName;
});

try {
    $db = new Database();
} catch (PDOException $e) {
    print "Where is no connection with database. Check the settings in config.inc.php file.";
    die();
}

require_once 'application/bootstrap.php';