<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josiah
 * Date: 11/23/2016
 * Time: 10:44 PM
 */
class View {

    protected $variables = array();

    function __construct() {

    }

    function set($name, $value) {
        $this->variables[$name] = $value;
    }

    function render($view_name) {
        extract($this->variables);

        if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $view_name . '.php')) {
            include (ROOT . DS . 'application' . DS . 'views' . DS . $view_name . '.php');
        }
        else {
            echo "file does not exist";
        }
    }

}