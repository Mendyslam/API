<?php

class App {

    private $db;

    public $result = "{}";

    function __construct() {

        $this->db = new Database();

            //first check if there are get variables in the url

            if(isset($_GET['url'])) {

            //get the url
            $url = $_GET['url'];

            //convert the url to an array and trim using the "/" seperator
            $URL = explode('/', trim($url, '/'));

            //get the table on the url from the database
            $table = $URL[0];

            //unset the table to remain only the id and other fields if present
            unset($URL[0]);

            //convert the remaining values to an array that begins with [0] as the index
            $params = array_values($URL);

            //ensure that the value of the table is a callable function in the App class
            if(is_callable([$this, $table])) {

                $this->result = $this->$table($params);
            
            }

        } else {

            $this->index();

        }
    }

    private function departments($params = array()) {

        $id = isset($params[0]) ? $params[0] : null;

        if($id) {

            $id = "d00$id";

            $data = $this->db->run("SELECT * FROM departments WHERE dept_no = :id LIMIT 1", ['id' => $id]);

            if(is_array($data)) {

                return json_encode($data);

            }

        } else {

            $data = $this->db->run("SELECT * FROM departments");

            if(is_array($data)) {

                return json_encode($data);

            } 

        }

        return "{}";

    }

    private function employees($params = array()) {

        $id = isset($params[0]) ? $params[0] : null;

        if($id) {
    
            $id = 10000 + (int)$id;

            $data = $this->db->run("SELECT * FROM employees WHERE emp_no = :id LIMIT 1", ['id' => $id]);

            if(is_array($data)) {

                return json_encode($data);

            } 

        } else {

            $data = $this->db->run("SELECT * FROM employees");

            if(is_array($data)) {

                return json_encode($data);

            } 

        }

        return "{}";

    }

    private function index() {

        require('home.php');

    }

}