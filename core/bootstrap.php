<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josiah
 * Date: 11/23/2016
 * Time: 8:30 PM
 */

function class_loader($className) {
    if(file_exists(ROOT . DS . 'core' . DS . $className . '.php')) {
        require_once (ROOT . DS . 'core' . DS . $className . '.php');
    }
    elseif (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . $className . '.php')) {
        require_once (ROOT . DS . 'application' . DS . 'controllers' . DS . $className . '.php');
    }
    elseif (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . $className . '.php')) {
        require_once (ROOT . DS . 'application' . DS . 'models' . DS . $className . '.php');
    }
}
spl_autoload_register('class_loader');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($url)) {
    Router::route($url);
}
else {
    Router::route("");
}