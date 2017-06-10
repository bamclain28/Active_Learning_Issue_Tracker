<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josiah
 * Date: 11/23/2016
 * Time: 9:05 PM
 */
class Controller extends Application {

    protected $controller;
    protected $action;
    protected $models;
    protected $view;

    public function __construct($controller, $action) {
        parent::__construct();

        $this->controller = $controller;
        $this->action = $action;
        $this->view = new View;
    }

    public function filter_input() {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
    }

    public function is_verified() {
        if(isset($_SESSION['user_verified'])) {
            if($_SESSION['user_verified'] === '1') {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function has_privileges($type) {
        if(isset($_SESSION['user_type'])) {
            if($_SESSION['user_type'] === $type) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    protected function load_model($model) {
        if(class_exists($model)) {
            $this->models[$model] = new $model();
        }
        else {
            echo "Class load failed";
        }
    }

    protected function get_model($model) {

        if(is_object($this->models[$model])) {
            return $this->models[$model];
        }
        else {
            return false;
        }
    }

    protected function get_view() {
        return $this->view;
    }
}