<?php

/**
 * @param string $className
 * @return void
 */
function payHelperAutoloader($className)
{
    $className = str_replace("Opencart\\System\\Library\\Pay", "", $className);
    $className = str_replace("Opencart\\System\\Library\\", "", $className);
    $file = __DIR__ . '/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('payHelperAutoloader');
