<?php
/**
 * Created by IntelliJ IDEA.
 * User: Josiah
 * Date: 11/23/2016
 * Time: 9:10 PM
 */
class Model {
    public $servername;
    public $username;
    public $password;
    public $db_name;
    public $conn;

    function __construct() {
        $config = parse_ini_file(dirname(__FILE__).'/..'.'/config/config-dev.ini');

        if($config['is_dev_env']) {
            $this->servername = $config['dev_servername'];
            $this->username = $config['dev_username'];
            $this->password = $config['dev_password'];
            $this->db_name = $config['dev_db_name'];
        }
        else {
            $this->servername = $config['prod_servername'];
            $this->username = $config['prod_username'];
            $this->password = $config['prod_password'];
            $this->db_name = $config['prod_db_name'];
        }

        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->db_name", $this->username, $this->password);
        }
        catch (PDOException $e) {
            echo "Database connection Failure";
            $this->conn = new PDO("mysql:host=$this->servername;", $this->username, $this->password);
        }


        if($config['is_dev_env']){
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }


    }


}