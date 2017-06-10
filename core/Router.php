<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josiah
 * Date: 11/23/2016
 * Time: 8:54 PM
 */

class Router {

    public static function route($url) {

        $url_array = array();
        $url_array = explode('/', $url);

        if (sizeof($url_array) > 1) {
            $controller = isset($url_array[0]) ? $url_array[0] : '';
            array_shift($url_array);

            $action = isset($url_array[0]) ? $url_array[0] : '';
            array_shift($url_array);

            $query_string = $url_array;

        }



        if(empty($controller) || !isset($controller)) {
            $controller = 'home';
        }

        if(empty($action) || !isset($action)) {
            $action = 'index';
        }

        if(empty($query_string) || !isset($query_string)) {
            $query_string = array();
        }

        $controller_name = $controller;
        $controller = ucwords($controller);
        $dispatch = new $controller($controller_name, $action);

        if (method_exists($controller, $action)) {



            call_user_func_array(array($dispatch, $action), $query_string);
        } else {
            echo "error";
        }

    }
}