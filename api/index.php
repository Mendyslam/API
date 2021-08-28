<?php

require('config.php');

spl_autoload_register(function($className) {
    require('classes/'.strtolower($className).'.php');
});

header('content-type:application/json;charset=utf-8');

$db = new Database();

//$data = $db->run("select * from departments");

$table = isset($_GET['table']) ? $_GET['table'] : null;

$id = isset($_GET['id']) ? $_GET['id'] : null;

switch($table) {

    case "departments":

        if($id) {

            $id = "d00$id";

            $data = $db->run("SELECT * FROM departments WHERE dept_no = :id LIMIT 1", ['id' => $id]);

            if(is_array($data)) {

                echo json_encode($data);

            } else {

                echo "{}";

            }
        } else {

            $data = $db->run("SELECT * FROM departments");

            if(is_array($data)) {

                echo json_encode($data);

            } else {

                echo "{}";

            }

        }

        break;

        case "employees":

            if($id) {
    
                $id = 10000 + (int)$id;
    
                $data = $db->run("SELECT * FROM employees WHERE emp_no = :id LIMIT 1", ['id' => $id]);
    
                if(is_array($data)) {
    
                    echo json_encode($data);
    
                } else {
    
                    echo "{}";
    
                }
            } else {
    
                $data = $db->run("SELECT * FROM employees");
    
                if(is_array($data)) {
    
                    echo json_encode($data);
    
                } else {
    
                    echo "{}";
    
                }
    
            }
    
            break;

    default:

        echo "{}";

        break;
}