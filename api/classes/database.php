<?php

class Database {

    private function connect() {

        $con = new PDO(DBDRIVER . ":host=" . HOST . ";dbname=" . DBNAME, USERNAME, PASSWORD);

        if(!$con) {
            die("could not connect");
        }

        return $con;

    }

    public function run(string $query, array $var = array()) {

        $con = $this->connect();

        $statement = $con->prepare($query);

        if($statement) {

            $check = $statement->execute($var);

            if($check) {

                $data = $statement->fetchAll(PDO::FETCH_OBJ);

                if(is_array($data) && count($data) > 0) {

                    return $data;

                }

            }
        }
        return false;
    }
}